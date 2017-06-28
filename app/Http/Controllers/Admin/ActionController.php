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

        return view('action.create', [
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
        $action = Action::with(['dossiers', 'comments', 'collection', 'payment'])->findOrFail($id);
        $user = Auth::user();
        if (!$user->can('update', $action)) {
            \Redirect::route('admin.home');
        }

        $dossier = $action->dossiers->first();
        $dossier_id = $dossier->id;

        $public = $dossier->pivot->public;
        $comments = $action->comments->all();
        $listActions = Listaction::all();
        $collection = $action->collection;

        //'admin.dossier.action.edit'
        return view('action.edit', [
            'route' => 'admin.dossier.action.store',
            'dossier_id' => $dossier_id,
            'public' => $public,
            'listActions' => $listActions,
            'action' => $action,
            'comments' => $comments,
            'collection' => $collection,
        ]);
    }

    public function store(Request $request)
    {
        $dossierData = $request->get('dossier');
        $actionData = $request->get('action');
        $collectionData = $request->get('collection');
        $commentData = $request->get('comment');
        $public = $request->get('action_dossier_public');

        $isNew = $actionData['id'] < 1 ? true : false;
        $dossier_id = $dossierData['id'];

        /** @var \App\Dossier $dossier */
        $dossier = Dossier::findOrFail($dossier_id);

        $actionData['status'] = 1;
        $actionData['description'] = 'nvt';
        if ($isNew) {
            $action = new Action();
        } else {
            $action_id = $actionData['id'];
            $action = Action::findOrFail($action_id);
        }
        $action->fill($actionData);
        $action->save();

        $dossier->actions()->sync([$action->id => ['public' => $public]], false);

        if ($action->listaction->description == 'betaling ontvangen') {
            $amount = $collectionData['amount'];
            if ($collectionData['id'] > 0) {
                $collect = \App\Collection::findOrFail($collectionData['id']);
                $collect->amount = $collectionData['amount'];
                $collect->save();
            } else {
                $collect = new \App\Collection();
                $collect->dossier_id = $dossier_id;
                $collect->amount = $collectionData['amount'];
                $action->collection()->save($collect);
            }
        }

        $comment = new Comment();
        $comment->comment = $commentData['comment'];
        if (!empty($comment->comment)) {
            $action->comments()->save($comment);
        }

        return \Redirect::route('admin.dossier.show', ['id' => $dossier_id]);
    }
}
