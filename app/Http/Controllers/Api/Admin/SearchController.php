<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Age;
use App\Models\Eon;
use App\Models\Epoch;
use App\Models\Era;
use App\Models\File;
use App\Models\FossilClass;
use App\Models\FossilCommon;
use App\Models\FossilFamily;
use App\Models\FossilGenre;
use App\Models\FossilKingdom;
use App\Models\FossilOrder;
use App\Models\FossilPhylum;
use App\Models\FossilSubgenre;
use App\Models\FossilTaxonomy;
use App\Models\MapResource;
use App\Models\News;
use App\Models\Period;
use App\Models\Resource;
use App\Models\SpecificEpithet;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');

        $groups = [
            'users' => [
                'name' => 'Kurator eller administrator',
                'display_field' => 'username',
                'items' => User::query()->where('role', '!=', 'customer'),
                'fields' => ['username', 'fossil_speciality', 'fossil_region']
            ],
            'customer' => [
                'name' => 'Bruger',
                'display_field' => 'username',
                'items' => User::query()->where('role', 'customer'),
                'fields' => ['username', 'fossil_speciality', 'fossil_region']
            ],
            'fossil-classes' => [
                'name' => 'Klasser',
                'display_field' => 'description',
                'items' => FossilClass::query(),
                'fields' => ['description']
            ],
            'fossil-commons' => [
                'name' => 'Danske navne',
                'display_field' => 'description',
                'items' => FossilCommon::query(),
                'fields' => ['description']
            ],
            'fossil-kingdoms' => [
                'name' => 'Riger',
                'display_field' => 'description',
                'items' => FossilKingdom::query(),
                'fields' => ['description']
            ],
            'fossil-phylums' => [
                'name' => 'Rækker',
                'display_field' => 'description',
                'items' => FossilPhylum::query(),
                'fields' => ['description']
            ],
            'fossil-orders' => [
                'name' => 'Ordrer',
                'display_field' => 'description',
                'items' => FossilOrder::query(),
                'fields' => ['description']
            ],
            'fossil-families' => [
                'name' => 'Familier',
                'display_field' => 'description',
                'items' => FossilFamily::query(),
                'fields' => ['description']
            ],
            'fossil-genres' => [
                'name' => 'Slægter',
                'display_field' => 'description',
                'items' => FossilGenre::query(),
                'fields' => ['description']
            ],
            'specific-epithets' => [
                'name' => 'Arter',
                'display_field' => 'description',
                'items' => SpecificEpithet::query(),
                'fields' => ['description']
            ],
            'fossil-taxonomies' => [
                'name' => 'Taksonomi-hjælper',
                'display_field' => 'description',
                'items' => FossilTaxonomy::query(),
                'fields' => ['description']
            ],
            'news' => [
                'name' => 'Nyheder',
                'display_field' => 'name',
                'items' => News::query(),
                'fields' => ['name', 'endpoint', 'description']
            ],
            'resources' => [
                'name' => 'Ressourcer',
                'display_field' => 'name',
                'items' => Resource::query()->whereNull('resource_id'),
                'fields' => ['name', 'endpoint', 'description', 'html']
            ],
            'files' => [
                'name' => 'Filer',
                'display_field' => 'name',
                'items' => File::query(),
                'fields' => ['name']
            ],
            'eons' => [
                'name' => 'Eoner',
                'display_field' => 'description',
                'items' => Eon::query(),
                'fields' => ['description']
            ],
            'eras' => [
                'name' => 'Æraer',
                'display_field' => 'description',
                'items' => Era::query(),
                'fields' => ['description']
            ],
            'periods' => [
                'name' => 'Perioder',
                'display_field' => 'description',
                'items' => Period::query(),
                'fields' => ['description']
            ],
            'epochs' => [
                'name' => 'Epoker',
                'display_field' => 'description',
                'items' => Epoch::query(),
                'fields' => ['description']
            ],
            'ages' => [
                'name' => 'Aldre',
                'display_field' => 'description',
                'items' => Age::query(),
                'fields' => ['description']
            ],
            'map-resources' => [
                'name' => 'Danmarks fossil- og geologiperler',
                'display_field' => 'title',
                'items' => MapResource::query(),
                'fields' => ['title', 'latitude', 'text', 'longitude']
            ],
        ];

        foreach ($groups as $key => $group) {
            $query = $group['items'];
            $query->where(function ($query) use ($group, $search) {
                foreach ($group['fields'] as $field) {
                    $query->orWhere($field, 'like', '%' . $search . '%');
                }
            });
            $groups[$key]['items'] = $query->take(5)->get();
        }

        return response()->json($groups);
    }
}
