<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Models\Fossil;
use App\Models\FossilClass;
use App\Models\FossilComment;
use App\Models\FossilCommon;
use App\Models\FossilGenre;
use App\Models\FossilIdentify;
use App\Models\FossilKingdom;
use App\Models\FossilOrder;
use App\Models\FossilFamily;
use App\Models\FossilPhylum;
use App\Models\FossilSubgenre;
use App\Models\FossilSubspecies;
use App\Models\Notification;
use App\Models\SpecificEpithet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FossilApiController extends Controller
{
    public function my_collection(Request $request) {
        return $this->getFossils($request, 'my-collection');
    }

    public function identify(Request $request) {
        return $this->getFossils($request, 'identify');
    }

    public function curated(Request $request) {
        return $this->getFossils($request, 'curated');
    }

    public function experts(Request $request) {
        return $this->getFossils($request, 'experts');
    }

    public function fossil_experts(Request $request) {
        return $this->getFossils($request, 'fossil-experts');
    }

    public function map(Request $request) {
        return $this->getFossils($request, 'map');
    }

    private function getFossils(Request $request, $origin) {
        $params = json_decode(base64_decode($request->query('params')), true);

        if (is_null($request->user())) {
            $user_id = null;
            $role = null;
        }
        else {
            $user_id = $request->user()->id;
            $role = $request->user()->role;
        }

        $options = [
            'search' => array_key_exists('search', $params) ? $params['search'] : null,
            'noValidated' => array_key_exists('noValidated', $params) ? $params['noValidated'] : null,
            'noClassified' => array_key_exists('noClassified', $params) ? $params['noClassified'] : null,
            'filter' => array_key_exists('filter', $params) ? $params['filter'] : null,
            'map' => array_key_exists('map', $params) ? $params['map'] : null,
            'user_id' => $user_id,
            'role' => $role,
            'origin' => $origin
        ];

        $fossils = Fossil::getFossils($options);

        return compact('fossils');
    }

    public function vote_user(Request $request) {
        $identify = FossilIdentify::find($request->id);
        $fossil = Fossil::where('id', $identify->fossil_id)
            ->with('fossil_identify')
            ->firstOrFail();

        $votes = $identify->vote_users_json;
        $add_vote = false;

        if($votes === null) {
            $votes = [ $request->user()->id ];
            $identify->vote_users_json = $votes;
            $add_vote = true;
        } else {
            $votesArray = json_decode($votes);

            $index = -1;
            for($i = 0; $i < count($votesArray); $i++ ){
                if($votesArray[$i] === $request->user()->id) {
                    $index = $i;
                    break;
                }
            }

            $saveVotes = null;
            if($index === -1) {
                $votesArray[] = $request->user()->id;
                $add_vote = true;
                $saveVotes = $votesArray;
            } else {
                unset($votesArray[$index]);
                $saveVotes = array_values($votesArray);
            }

            $identify->vote_users_json = count($saveVotes) > 0 ? $saveVotes : null;
        }

        $identify->vote_user = $identify->vote_users_json === null ? 0 : count($identify->vote_users_json);
        $identify->save();

        $validated_fossil = false;
        $identifies = FossilIdentify::where('fossil_id', $fossil->id)->get();

        foreach ($identifies as $item){
            if($add_vote === true && $item->id != $identify->id) {
                if($item->vote_users_json !== null) {
                    $votesArray = json_decode($item->vote_users_json);

                    $index = -1;
                    for($i = 0; $i < count($votesArray); $i++ ){
                        if($votesArray[$i] === $request->user()->id) {
                            $index = $i;
                            break;
                        }
                    }

                    if($index !== -1) {
                        unset($votesArray[$index]);
                        $saveVotes = array_values($votesArray);

                        $item->vote_user = count($saveVotes);
                        $item->vote_users_json = count($saveVotes) > 0 ? $saveVotes : null;
                        $item->save();

                        $identify->unvoted_id = $item->id;
                        $identify->unvoted_count = $item->vote_user;
                        $identify->unvoted_json = $item->vote_users_json;
                    }
                }
            }

            if($item->vote_user >= 5) {
                $validated_fossil = true;
            }
        }

        $send = false;
        if(!$fossil->validated_fossil && $validated_fossil) {
            $send = true;
        }

        if($fossil->fossil_identify_id !== $identify->id) {
            if(!$fossil->fossil_identify->vote_curator) {
                $votesPrincipal = $fossil->fossil_identify_id === $identify->unvoted_id ?
                    $identify->unvoted_count : $fossil->fossil_identify->vote_user;

                if($votesPrincipal < $identify->vote_user) {
                    $fossil->fossil_identify_id = $identify->id;
                    $identify->principal = true;
                }
            }
        }

        $fossil->validated_fossil = $validated_fossil;
        
        $fossil->save();

        if($add_vote && $send) {
            if($fossil->user_id !== $request->user()->id) {
                Notification::create([
                    'type' => 'vote-user',
                    'user_id' => $fossil->user_id,
                    'fossil_id' => $fossil->id,
                    'user_notificator_id' => $request->user()->id,
                    'title' => __('notifications.vote_user_title'),
                    'text' => __('notifications.vote_user_text'),
                    'viewed' => false
                ]);
            }
        }

        $identify->validated_fossil = $fossil->validated_fossil;

        return $identify;
    }

    public function vote_curator(Request $request) {
        $identify = FossilIdentify::find($request->id);
        $fossil = Fossil::where('id', $identify->fossil_id)->with('fossil_identifies')->firstOrFail();

        $identify->vote_curator = !$identify->vote_curator;
        $identify->vote_curator_id = $identify->vote_curator ? $request->user()->id : null;
        $identify->vote_curator_date = $identify->vote_curator ? Carbon::now() : null;
        $identify->save();

        $vote = false;

        $identify->principal = false;
        $identify_votes = 0;
        $identify_votes_item = null;

        foreach ($fossil->fossil_identifies as $item) {
            if($item->id !== $identify->id) {
                if($item->vote_curator) {
                    $item->vote_curator_id = null;
                    $item->vote_curator = false;
                    $item->vote_curator_date = null;
                    $item->save();
                }

                if($item->vote_user > $identify_votes) {
                    $identify_votes_item = $item;
                    $identify_votes = $item->vote_user;
                }
            }
        }

        if($identify->vote_curator) {
            $fossil->vote_curator = true;
            $vote = true;
            $identify->principal = true;

            if($fossil->fossil_identify_id !== $identify->id) {
                $fossil->fossil_identify_id = $identify->id;
            }
        } else {
            $identify->principal = false;

            $fossil->vote_curator = false;
           
            if($identify_votes_item !== null) {
                $fossil->fossil_identify_id = $identify_votes_item->id;
                $identify->principal_item = $identify_votes_item;
            }
        }

        $identify->fossil_vote_curator = $fossil->vote_curator;
        $identify->vote_curator_user = $request->user();

        $fossil->save();

        if($vote) {
            if($fossil->user_id !== $request->user()->id) {
                Notification::create([
                    'type' => 'vote-curator',
                    'user_id' => $fossil->user_id,
                    'fossil_id' => $fossil->id,
                    'user_notificator_id' => $request->user()->id,
                    'title' => __('notifications.vote_curator_title'),
                    'text' => __('notifications.vote_curator_text'),
                    'viewed' => false
                ]);
            }
        }

        return $identify;
    }

    public function vote_scientific(Request $request) {
        $fossil = Fossil::find($request->id);
        $fossil->vote_scientific = !$fossil->vote_scientific;
        $fossil->vote_scientific_id = $fossil->vote_scientific ? $request->user()->id : null;
        $fossil->vote_scientific_date = $fossil->vote_scientific ? Carbon::now() : null;

        if(!$fossil->vote_scientific) {
            $identifies = FossilIdentify::where('fossil_id', $fossil->id)->get();
            $vote = false;
            foreach ($identifies as $item){
                if($item->vote_curator) {
                    $vote = true;
                    break;
                }
            }
            $fossil->vote_curator = $vote;
        } else {
            //$fossil->vote_curator = true;
        }

        $fossil->save();

        if($fossil->vote_scientific) {
            if($fossil->user_id !== $request->user()->id) {
                Notification::create([
                    'type' => 'vote-scientific',
                    'user_id' => $fossil->user_id,
                    'fossil_id' => $fossil->id,
                    'user_notificator_id' => $request->user()->id,
                    'title' => __('notifications.vote_scientific_title'),
                    'text' => __('notifications.vote_scientific_text'),
                    'viewed' => false
                ]);
            }
        }

        $fossil->vote_scientific_user = $request->user();

        return $fossil;
    }

    public function vote_danekrae(Request $request) {
        $fossil = Fossil::find($request->id);
        $fossil->vote_danekrae = !$fossil->vote_danekrae;
        $fossil->save();

        if($fossil->vote_danekrae) {
            if($fossil->user_id !== $request->user()->id) {
                Notification::create([
                    'type' => 'vote-danekrae',
                    'user_id' => $fossil->user_id,
                    'fossil_id' => $fossil->id,
                    'user_notificator_id' => $request->user()->id,
                    'title' => __('notifications.vote_danekrae_title'),
                    'text' => __('notifications.vote_danekrae_text'),
                    'viewed' => false
                ]);
            }
        }

        return $fossil;
    }

    public function identify_data()
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

        return compact(
            'commons', 'kingdoms', 'phylums', 'classes', 'orders',
            'families', 'genres', 'subgenres', 'specific_epithets', 'subspecies'
        );
    }

    public function save_identify(Request $request)
    {
        $identify = new FossilIdentify();
        $fossil = Fossil::where('id', $request->fossil_id)
            ->with('fossil_identify')
            ->firstOrFail();

        $identify->fill( $request->all() );
        $identify->user_id = $request->user()->id;
        $identify->vote_curator = false;
        $identify->vote_expert = false;
        $identify->vote_user = 0;

        $identify->save();

        if($fossil->fossil_identify_id === null || ($fossil->fossil_identify->fossil_kingdom === trans('messages.forms.unknown') &&
        $fossil->fossil_identify->fossil_common === trans('messages.forms.unknown') &&
        $fossil->fossil_identify->fossil_phylum === trans('messages.forms.unknown') &&
        $fossil->fossil_identify->fossil_class === trans('messages.forms.unknown') &&
        $fossil->fossil_identify->fossil_order === trans('messages.forms.unknown') &&
        $fossil->fossil_identify->fossil_family === trans('messages.forms.unknown') &&
        $fossil->fossil_identify->fossil_genre === trans('messages.forms.unknown') &&
        $fossil->fossil_identify->specific_epithet === trans('messages.forms.unknown'))) {
            $fossil->fossil_identify_id = $identify->id;
            $fossil->save();
            $identify->principal = true;
        }

        $identify->user = $request->user();

        if($fossil->user_id !== $request->user()->id) {
            Notification::create([
                'type' => 'new-identify',
                'user_id' => $fossil->user_id,
                'fossil_id' => $fossil->id,
                'user_notificator_id' => $request->user()->id,
                'title' => __('notifications.new_identify_title'),
                'text' => __('notifications.new_identify_text'),
                'viewed' => false
            ]);
        }

        return $identify;
    }

    public function add_comment(Request $request) {
        $comment = new FossilComment();
        $comment->fill( $request->all() );
        $comment->user_id = $request->user()->id;
        $comment->save();

        $comment->user = $request->user();

        $fossil = Fossil::find($comment->fossil_id);

        if($fossil->user_id !== $request->user()->id) {
            Notification::create([
                'type' => 'new-comment',
                'user_id' => $fossil->user_id,
                'fossil_id' => $fossil->id,
                'user_notificator_id' => $request->user()->id,
                'title' => __('notifications.new_comment_title'),
                'text' => __('notifications.new_comment_text'),
                'viewed' => false
            ]);
        }

        $comments = FossilComment::getComments($request->fossil_id);

        foreach ($comments as $i) {
            if($i->user_id !== null) {
                $comments_ids[] = $i->user_id;
            }
        }
        $comments_ids = array_unique($comments_ids); // Array is now (1, 2, 3)

        foreach ($comments_ids as $i) {
            if(($request->user()->id !== $i) && ($fossil->user_id !== $i)) {
                Notification::create([
                    'type' => 'new-comment',
                    'user_id' => $i,
                    'fossil_id' => $fossil->id,
                    'user_notificator_id' => $request->user()->id,
                    'title' => __('notifications.new_comment_title_yourself'),
                    'text' => __('notifications.new_comment_text_yourself'),
                    'viewed' => false
                ]);
            }
        }

        return $comment;
    }

    public function delete_comment(Request $request) {
        $comment = FossilComment::find($request->id);
        $fossil = Fossil::find($comment->fossil_id);

        $comment->delete();

        if($fossil->user_id !== $request->user()->id) {
            Notification::create([
                'type' => 'delete-comment',
                'user_id' => $comment->user_id,
                'fossil_id' => $fossil->id,
                'user_notificator_id' => $request->user()->id,
                'title' => __('notifications.delete_comment_title'),
                'text' => __('notifications.delete_comment_text'),
                'viewed' => false
            ]);
        }

        return $comment;
    }

    public function desactive_fossil(Request $request) {
        $fossil = Fossil::find($request->id);

        $fossil->active = false;
        $fossil->save();

        if($fossil->user_id !== $request->user()->id) {
            $title = str_replace('{{fossil_id}}', $fossil->id, __('notifications.fossil_inactive_title'));
            $text = str_replace('{{fossil_id}}', $fossil->id, __('notifications.fossil_inactive_text'));

            Notification::create([
                'type' => 'fossil-update',
                'user_id' => $fossil->user_id,
                'user_notificator_id' => $request->user()->id,
                'fossil_id' => $fossil->id,
                'title' => $title,
                'text' => $text,
                'viewed' => false
            ]);
        }

        return $fossil;
    }

    public function active_fossil(Request $request) {
        $fossil = Fossil::find($request->id);

        $fossil->active = true;
        $fossil->save();
        /*
        if($fossil->user_id !== $request->user()->id) {
            $title = str_replace('{{fossil_id}}', $fossil->id, __('notifications.fossil_active_title'));
            $text = str_replace('{{fossil_id}}', $fossil->id, __('notifications.fossil_active_text'));

            Notification::create([
                'type' => 'fossil-update',
                'user_id' => $fossil->user_id,
                'user_notificator_id' => $request->user()->id,
                'fossil_id' => $fossil->id,
                'title' => $title,
                'text' => $text,
                'viewed' => false
            ]);
        }
        */
        return $fossil;
    }

    public function users_votes(Request $request) {
        $identifies = FossilIdentify::getFossilIdentifies($request->fossil_id);

        $allIds = [];

        foreach ($identifies as $i) {
            if($i->vote_users_json !== null) {
                $ids = json_decode($i->vote_users_json);

                if(is_array($ids)) {
                    $allIds = array_merge( $allIds, $ids );
               }
            }
        }

        $users = User::getByIds($allIds);

        $result = [

        ];

        foreach ($identifies as $i) {
            if($i->vote_users_json !== null) {
                $ids = json_decode($i->vote_users_json);

                $identify = [
                    'id' => $i->id,
                    'users' => []
                ];

                foreach ($ids as $id) {
                    foreach ($users as $user) {
                        if($user->id == $id) {
                            $identify['users'][] = $user;
                        }
                    }
                }

                $result[] = $identify;
            }
        }

        return $result;
    }
}
