<?php

namespace App\Http\Controllers\Admin;

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
        $action = new Action();
        $comment = new Comment();
        $listActions = Listaction::all();

        return view('admin.dossier.action.create', [
            'dossier_id' => $id,
            'listActions' => $listActions,
            'action' => $action,
            'comment' => $comment
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|View
     */
    public function edit($id, Request $request)
    {

        $action = new Action();
        $comment = new Comment();

        return view('admin.dossier.action.edit', ['dossier_id' => $id, 'action' => $action, 'comment' => $comment]);
    }

    public function store(Request $request)
    {
        $isNew = !$request->has('id') && $request->get('id') < 1;
        $dossier_id = $request->get('did');
        /** @var \App\Dossier $dossier */
        $dossier = Dossier::findOrFail($dossier_id);

        if ($isNew) {
            $action = new Action();
            $action->created_at = date('Y-m-d H:i:s');
            $action->listactions_id =  $request->get('listactions_id');
            $action->title =  $request->get('title');
        } else {
            $action_id = $request->get('id');
            $action = Action::findOrFail($action_id);
            $action->updated_at = date('Y-m-d H:i:s');
            $action->listactions_id =  $request->get('listactions_id');
            $action->title =  $request->get('title');
        }
        $action->status =  '1';
        $action->description = 'nvt';

        /** @var \App|Action $action */
        $action = $dossier->actions()->withTimestamps()->save($action);

        $comment = new Comment();
        $comment->comment = $request->get('comment');

        $action->comments()->withTimestamps()->save($comment);


        return \Redirect::route('admin.dossier.show',['id' => $dossier_id]);
    }
}
