<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Dossier;
use App\Models\Action;
use App\Models\Comment;
use App\Models\Listaction;
use Illuminate\View\View;

class CommentController extends Controller
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
        if (!$user->can('create', Comment::class)) {
            \Redirect::route('admin.home');
        }

        $comment = new Comment();

        return view('action.create', [
            'route' => 'admin.comment.store',
            'dossier_id' => $id,
            'comments' => $comment
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|RedirectResponse|View
     */
    public function edit(Comment $comment, Request $request)
    {
        /** @var \App\Models\Action $action */
        $user = Auth::user();
        if (!$user->can('update', $comment)) {
            \Redirect::route('admin.home');
        }

        //'admin.dossier.action.edit'
        return view('comment.edit', [
            'route' => 'admin.comment.store',
            'comment' => $comment
        ]);
    }

    public function store(Request $request)
    {
        $comment_id = $request->get('id');
        if ($comment_id) {
            $comment = Comment::findOrFail($comment_id);
        } else {
            $comment = new Comment();
        }
        $comment->fill($request->all());
        $comment->save();

        return \Redirect::back();
    }
}
