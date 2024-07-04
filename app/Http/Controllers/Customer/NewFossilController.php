<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\FossilRequest;
use App\Models\Age;
use App\Models\Country;
use App\Models\County;
use App\Models\Eon;
use App\Models\Epoch;
use App\Models\Era;
use App\Models\Fossil;
use App\Models\FossilClass;
use App\Models\FossilComment;
use App\Models\FossilCommon;
use App\Models\FossilFamily;
use App\Models\FossilGenre;
use App\Models\FossilIdentify;
use App\Models\FossilKingdom;
use App\Models\FossilOrder;
use App\Models\FossilPhylum;
use App\Models\FossilSubgenre;
use App\Models\FossilSubspecies;
use App\Models\FossilTaxonomy;
use App\Models\Image;
use App\Models\Notification;
use App\Models\Period;
use App\Models\SpecificEpithet;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class NewFossilController extends Controller
{
    public function index()
    {
        $commons = FossilCommon::getDropdownQuery()->get();
        $kingdoms = FossilKingdom::getDropdownQuery()->get();
        $phylums = FossilPhylum::getDropdownQuery()->get();
        $classes = FossilClass::getDropdownQuery()->get();
        $orders = FossilOrder::getDropdownQuery()->get();
        $families = FossilFamily::getDropdownQuery()->get();
        $genres = FossilGenre::getDropdownQuery()->get();
        $subgenres = FossilSubgenre::getDropdownQuery()->get();
        $specific_epithets = SpecificEpithet::getDropdownQuery()->get();
        $subspecies = FossilSubspecies::getDropdownQuery()->get();
        $countries = Country::getDropdownQuery()->get();
        $counties = County::getDropdownQuery()->get();
        $eons = Eon::getDropdownQuery()->get();
        $eras = Era::getDropdownQuery()->get();
        $periods = Period::getDropdownQuery()->get();
        $epoches = Epoch::getDropdownQuery()->get();
        $ages = Age::getDropdownQuery()->get();
        $taxonomies = FossilTaxonomy::getTaxonomies();
        $geochronologies = Age::getGroupDropdown();

        return Inertia::render('Customer/NewFossil/Index', compact(
            'commons', 'kingdoms', 'phylums', 'classes', 'orders',
            'families', 'genres', 'subgenres', 'specific_epithets', 'subspecies',
            'countries', 'counties', 'eons', 'eras', 'periods', 'epoches', 'ages','taxonomies','geochronologies'
        ));
    }

    public function store(FossilRequest $request)
    {
        $data = $request->all();

        $lat = $request->input('latitude');
        $long = $request->input('longitude');
        if($lat && $long) {
            $fossilsWithSameCord = Fossil::where('latitude', 'LIKE', '%'.$this->truncateToThreeDecimalPlaces($lat).'%')
                ->where('longitude', 'LIKE', '%'.$this->truncateToThreeDecimalPlaces($long).'%')
                ->first();
            if($fossilsWithSameCord) {
                $data['latitude'] = $this->replaceRandomDigits($lat);
                $data['longitude'] = $this->replaceRandomDigits($long);
            }
        }

        $fossil = new Fossil($data);
        $fossil->user_id = $request->user()->id;
        $fossil->copyright_rule_id = $request->user()->copyright_rule_id;

        $urlImages = $request->guardarFoto('images', '/images', null);

        $fossil->save();

        $i = 0;
        if($urlImages) {
            foreach ($urlImages as $urlImage){
                if($urlImage) {
                    $image = new Image([
                        'path' => $urlImage,
                        'fossil_id' => $fossil->id,
                        'principal' => $i === 0
                    ]);

                    $image->save();
                }
                $i++;
            }
        }

        $fossil_identify = new FossilIdentify($data['fossil_identifies'][0]);
        $fossil_identify->fossil_id = $fossil->id;
        $fossil_identify->user_id = $request->user()->id;

        $fossil_identify->save();

        $fossil->fossil_identify_id = $fossil_identify->id;
        $fossil->save();

        return Redirect::route('customer.my-collection');
    }

    public function destroy(Request $request){
        $fossil = Fossil::getFossil($request->fossil_id);

        if(($request->action === 'delete')||($request->action === 'delete-report')) {
            $fossil->fossil_identify_id = null;
            $fossil->save();

            foreach ($fossil->images as $image) {
                $path = storage_path('app/public') . str_replace('/storage','', $image->path);

                if(is_file($path)) {
                    unlink($path);
                }

                $image->delete();
            }

            foreach ($fossil->fossil_identifies as $identify){
                $identify->delete();
            }

            foreach ($fossil->fossil_comments as $comment) {
                $comment->delete();
            }

            $fossil->delete();

            if($request->action === 'delete'){
                $title = __('notifications.fossil_deleted_title');
                $text = __('notifications.fossil_deleted_text');
            } else  {
                $title = __('notifications.fossil_deleted_report_title');
                $text = __('notifications.fossil_deleted_report_text');
            }

            if($fossil->user_id !== $request->user()->id) {
                Notification::create([
                    'type' => 'deleted-fossil',
                    'user_id' => $fossil->user_id,
                    'user_notificator_id' => $request->user()->id,
                    'fossil_id' => $fossil->id,
                    'title' => $title,
                    'text' => $text,
                    'viewed' => false
                ]);
            }
        } else if($request->action === 'notify') {
            $fossil->send_delete = true;
            $fossil->save();

            $admins = User::getUserAdmin(false, true);

            $text = str_replace('{{user_name}}', $request->user()->name, __('notifications.fossil_send_delete_text'));

            foreach ($admins as $admin) {
                if($admin->id !== $request->user()->id) {
                    Notification::create([
                        'type' => 'send-delete-fossil',
                        'user_id' => $admin->id,
                        'user_notificator_id' => $request->user()->id,
                        'fossil_id' => $fossil->id,
                        'title' => __('notifications.fossil_send_delete_title'),
                        'text' => $text,
                        'viewed' => false
                    ]);
                }
            }
        }

        $route = match ($request->origin) {
            'dashboard' => 'customer.dashboard',
            'my-collection' => 'customer.my-collection',
            'profile' => 'customer.profile.edit',
            'identify-find' => 'customer.identify-finds',
            'curated' => 'customer.e-museum.curated',
            'experts' => 'customer.e-museum.experts',
            'fossil-experts' => 'customer.e-museum.fossil_experts',
            'map' => 'customer.e-museum.map',
            default => 'customer.new-fossil.edit'
        };

        $param = $route === 'customer.new-fossil.edit' ? $fossil->id : [ "fossil" => $fossil->id ];

        return Redirect::route($route, $param);
    }

    public function edit(Request $request, $id) {
        $fossil = Fossil::getFossil( $id );
        $role = $request->user()->role;

        if($fossil == null) {
            abort(404);
        }

        if($role !== 'admin' && $role !== 'curator') {
            if($fossil->user_id !== $request->user()->id) {
                abort(404);
            }
        }

        $origin = null;
        if($request->query('origin')) {
            $origin = $request->query('origin');
        }

        $commons = FossilCommon::getDropdownQuery()->get();
        $kingdoms = FossilKingdom::getDropdownQuery()->get();
        $phylums = FossilPhylum::getDropdownQuery()->get();
        $classes = FossilClass::getDropdownQuery()->get();
        $orders = FossilOrder::getDropdownQuery()->get();
        $families = FossilFamily::getDropdownQuery()->get();
        $genres = FossilGenre::getDropdownQuery()->get();
        $subgenres = FossilSubgenre::getDropdownQuery()->get();
        $specific_epithets = SpecificEpithet::getDropdownQuery()->get();
        $subspecies = FossilSubspecies::getDropdownQuery()->get();
        $countries = Country::getDropdownQuery()->get();
        $counties = County::getDropdownQuery()->get();
        $eons = Eon::getDropdownQuery()->get();
        $eras = Era::getDropdownQuery()->get();
        $periods = Period::getDropdownQuery()->get();
        $epoches = Epoch::getDropdownQuery()->get();
        $ages = Age::getDropdownQuery()->get();
        $taxonomies = FossilTaxonomy::getTaxonomies();
        $geochronologies = Age::getGroupDropdown();

        return Inertia::render('Customer/NewFossil/Edit', compact(
            'fossil', 'commons', 'kingdoms', 'phylums', 'classes', 'orders',
            'families', 'genres', 'subgenres', 'specific_epithets', 'subspecies',
            'countries', 'counties', 'eons', 'eras', 'periods', 'epoches', 'ages','taxonomies','geochronologies',
            'origin'
        ));
    }

    public function update(FossilRequest $request, $id)
    {
        $data = $request->all();
        $fossil = Fossil::findOrFail($id);
        $fossil->fill( $data );

        $urlImages = $request->guardarFoto('images', '/images', null);

        $i = 0;

        $oldImages = Image::where('fossil_id', $id)->get();
        $deleted = false;

        foreach ($oldImages as $image) {
            $path = storage_path('app/public') . str_replace('/storage','', $image->path);
            $existe = false;

            foreach ($data['images'] as $dataImage) {
                if(array_key_exists('id', $dataImage)) {
                    if($dataImage['id'] == $image->id) {
                        $existe = true;
                    }
                }
            }

            if(!$existe) {
                if(is_file($path)) {
                    unlink($path);
                    $deleted = true;
                }
            }

            $image->delete();
        }

        foreach ($data['images'] as $dataImage) {
            if(array_key_exists('path', $dataImage)) {
                $image = new Image([
                    'path' => $dataImage['path'],
                    'fossil_id' => $fossil->id,
                    'principal' => $i === 0
                ]);

                $image->save();

                $i++;
            }
        }

        if($urlImages) {
            foreach ($urlImages as $urlImage){
                if($urlImage) {
                    $image = new Image([
                        'path' => $urlImage,
                        'fossil_id' => $fossil->id,
                        'principal' => $i === 0
                    ]);

                    $image->save();

                    $i++;
                }
            }
        }

        if($deleted) {
            if($fossil->user_id !== $request->user()->id) {
                $text = str_replace('{{fossil_id}}', $fossil->id, __('notifications.image_deleted_text'));
                $text = str_replace('{{motive}}', $request->motive_delete, $text );

                Notification::create([
                    'type' => 'image-deleted',
                    'user_id' => $fossil->user_id,
                    'user_notificator_id' => $request->user()->id,
                    'fossil_id' => $fossil->id,
                    'title' => __('notifications.image_deleted_title'),
                    'text' => $text,
                    'viewed' => false
                ]);
            }
        }

        if($fossil->user_id !== $request->user()->id) {
            $fossil->send_report = false;
        } else {
            $fossil->send_delete = false;
        }

        $fossil->save();

        if($fossil->user_id !== $request->user()->id) {
            $text = str_replace('{{fossil_id}}', $fossil->id, __('notifications.fossil_update_text'));

            Notification::create([
                'type' => 'fossil-update',
                'user_id' => $fossil->user_id,
                'user_notificator_id' => $request->user()->id,
                'fossil_id' => $fossil->id,
                'title' => __('notifications.fossil_update_title'),
                'text' => $text,
                'viewed' => false
            ]);
        }

        $route = match ($request->origin) {
            'dashboard' => 'customer.dashboard',
            'my-collection' => 'customer.my-collection',
            'profile' => 'customer.profile.edit',
            'identify-find' => 'customer.identify-finds',
            'curated' => 'customer.e-museum.curated',
            'experts' => 'customer.e-museum.experts',
            'fossil-experts' => 'customer.e-museum.fossil_experts',
            'map' => 'customer.e-museum.map',
            default => 'customer.new-fossil.edit'
        };

        $param = $route === 'customer.new-fossil.edit' ? $fossil->id : [ "fossil" => $fossil->id ];

        return Redirect::route($route, $param);
    }

    function truncateToThreeDecimalPlaces($number): string
    {
        $explodedNumber = explode('.', $number);
        if(!$afterDot = Arr::get($explodedNumber, 1)) {
            return $number;
        } else {
            return $explodedNumber[0] . '.' . substr($afterDot, 0, 3);
        }
    }


    private function replaceRandomDigits($number): float
    {
        $numberStr = (string) $number;

        $dotPos = strpos($numberStr, '.');
        if ($dotPos === false) {
            return $number;
        }

        $beforeDot = substr($numberStr, 0, $dotPos + 1);
        $afterDot = substr($numberStr, $dotPos + 1);

        if (strlen($afterDot) < 5) {
            return $number;
        }

        $randomDigit1 = rand(0, 9);
        $randomDigit2 = rand(0, 9);

        $afterDot[2] = $randomDigit1;
        $afterDot[3] = $randomDigit2;

        $newNumberStr = $beforeDot . $afterDot;

        return (float) $newNumberStr;
    }
}
