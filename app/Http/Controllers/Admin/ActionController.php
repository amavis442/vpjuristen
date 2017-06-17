<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Dossier;
use App\Action;
use App\Comment;
use App\Listaction;
use Illuminate\View\View;

class ActionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }


    public function index()
    {
    }

    public function create($id, Request $request)
    {
        $user = Auth::user();
        if (!$user->can('create', Action::class)) {
            \Redirect::route('admin.home');
        }

        $commentCollection = new Collection();

        $action = new Action();
        $comment = new Comment();
        $commentCollection->add($comment);
        $listActions = Listaction::all();

        return view('common.action.create', [
            'route' => 'admin.dossier.action.store',
            'dossier_id' => $id,
            'listActions' => $listActions,
            'action' => $action,
            'comments' => $commentCollection
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|View
     */
    public function edit($id, Request $request)
    {
        /** @var \App\Action $action */
        $action = Action::findOrFail($id);
        $dossier_id = $action->dossier()->get()->first()->id;

        $user = Auth::user();
        if (!$user->can('update', $action)) {
            \Redirect::route('admin.home');
        }

        $actionRoles = $action->roles();
        $r = $actionRoles->get()->all();
        $checkClient = false;
        $checkDebtor = false;
        if ($r) {
            foreach ($r as $role) {
                if ($role->name == 'client') {
                    $checkClient = true;
                }
                if ($role->name == 'debtor') {
                    $checkDebtor = true;
                }
            }
        }

        $comments = $action->comments()->get()->all();
        $listActions = Listaction::all();
        $collection = $action->collection()->get()->first();

        //'admin.dossier.action.edit'
        return view('common.action.edit', [
            'route' => 'admin.dossier.action.store',
            'dossier_id' => $dossier_id,
            'listActions' => $listActions,
            'action' => $action,
            'comments' => $comments,
            'checkClient' => $checkClient,
            'checkDebtor' => $checkDebtor,
            'collection' => $collection,
        ]);
    }

    public function store(Request $request)
    {
        $dossierData = $request->get('dossier');
        $actionData = $request->get('action');
        $collectionData = $request->get('collection');
        $commentData = $request->get('comment');
        $roleData = $request->get('role');


        $isNew = $actionData['id'] < 1 ? true : false;
        $dossier_id = $dossierData['id'];
        /** @var \App\Dossier $dossier */
        $dossier = Dossier::findOrFail($dossier_id);

        if ($isNew) {
            $action = new Action();
            $action->created_at = date('Y-m-d H:i:s');
            $action->listaction_id = $actionData['listaction_id'];
            $action->title = $actionData['title'];
        } else {
            $action_id = $actionData['id'];
            $action = Action::findOrFail($action_id);
            $action->updated_at = date('Y-m-d H:i:s');
            $action->listaction_id = $actionData['listaction_id'];
            $action->title = $actionData['title'];
        }
        $action->status = '1';
        $action->description = 'nvt';

       if ($isNew) {
            /** @var \App|Action $action */
            $action = $dossier->actions()->withTimestamps()->save($action);
        } else {
            $action->save();
        }
        $attachedRoles = $action->roles()->get();
        $action->roles()->detach($attachedRoles);

        // Which roles can see the action
        $rolesAllowedToSee = $roleData;
        if (!is_null($rolesAllowedToSee)) {
            foreach ($rolesAllowedToSee as $roleAllowedToSee) {
                /** @var \App\Role $role */
                $role = Role::where('name','=',$roleAllowedToSee)->first();
                $action->roles()->withTimestamps()->attach($role->id);
            }
        }

        if ($action->listaction->description == 'betaling ontvangen') {
            $amount = $collectionData['amount'];
            if ($collectionData['id'] > 0){
                $collect = \App\Collection::findOrFail($collectionData['id']);
                $collect->amount =  $collectionData['amount'];
                $collect->updated_at = date('Y-m-d H:i:s');
                $collect->save();
            } else {
                $collect = new \App\Collection();
                $collect->dossier_id = $dossier_id;
                $collect->amount = $collectionData['amount'];
                $collect->created_at = date('Y-m-d H:i:s');
                $collect->updated_at = date('Y-m-d H:i:s');
                $action->collection()->save($collect);

            }
        }

        $comment = new Comment();
        $comment->comment = $commentData['comment'];
        if (!empty($comment->comment)) {
            $action->comments()->withTimestamps()->save($comment);
        }

        return \Redirect::route('admin.dossier.show', ['id' => $dossier_id]);
    }
}
