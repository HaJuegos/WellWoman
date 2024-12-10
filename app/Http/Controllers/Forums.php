<?php

namespace App\Http\Controllers;

use App\Models\Foro;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Forums extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $foros = Foro::with('usuarios', 'creador')->get();

        $likesData = $foros->filter(function ($foro) use ($userId) {
            return $foro->usuarios->contains(function ($usuario) use ($userId) {
                return $usuario->pivot->user_id == $userId && $usuario->pivot->has_like == true;
            });
        })->mapWithKeys(function ($foro) {
            return [$foro->id => true];
        });

        $user = Auth::user() ?? null;
        $roles = null;

        $roles = (!$user) ? ["Visitante"] : $user->roles->pluck('type')->toArray();

        $pageId = 'postPage';

        return view('forums.index', ['pageId' => $pageId, 'foros' => $foros, 'likesData' => $likesData, 'roles' => $roles]);
    }

    public function addForum(Request $rqs)
    {
        $user = Auth::user();

        Foro::create([
            'name' => $rqs->input('name'),
            'content' => $rqs->input('content'),
            'time_creation' => now(),
            'user_id' => $user->id,
        ]);

        return redirect()->route('forum.index')->with('postCreate', true);
    }

    public function updateLikes(Request $rqs)
    {
        $idForum = $rqs->input('idForum');
        $newLike = $rqs->input('newLike');

        $foro = Foro::find($idForum);
        $user = Auth::user();

        $pivot = $foro->usuarios()->wherePivot('user_id', $user->id)->first();

        if ($newLike) {
            $foro->likes += 1;

            if (!$pivot) {
                $foro->usuarios()->attach($user->id, ['has_like' => true]);
            } else {
                $foro->usuarios()->updateExistingPivot($user->id, ['has_like' => true]);
            }
        } else {
            if ($pivot) {
                $foro->usuarios()->updateExistingPivot($user->id, ['has_like' => false]);
                $foro->likes = max(0, $foro->likes - 1);
            }
        }

        $foro->save();

        return response()->json(['success' => true, 'message' => 'Like actualizado correctamente']);
    }

    public function deletedPost($id)
    {
        $foro = Foro::find($id);

        $foro->comentarios()->delete();
        $foro->delete();

        return redirect()->route('forum.index')->with('postDeleted', true);
    }

    public function viewComments($id)
    {
        $userId = Auth::id();
        $foro = Foro::with(['comentarios', 'usuarios', 'creador'])->findOrFail($id);
        $comentarios = Comentario::with('likeUsuarios')->get();

        $likesData = $foro->usuarios->contains(function ($usuario) use ($userId) {
            return $usuario->pivot->user_id == $userId && $usuario->pivot->has_like == true;
        }) ? [$foro->id => true] : [];

        $likesDataComments = $comentarios->filter(function ($comentario) use ($userId) {
            return $comentario->likeUsuarios->contains(function ($usuario) use ($userId) {
                return $usuario->pivot->user_id == $userId && $usuario->pivot->has_like == true;
            });
        })->mapWithKeys(function ($comentario) {
            return [$comentario->id => true];
        });

        $user = Auth::user();
        $roles = $user ? $user->roles->pluck('type')->toArray() : ["Visitante"];

        $pageId = 'commentsPage';

        return view("forums.comments", ['pageId' => $pageId, 'foro' => $foro, 'likesData' => $likesData, 'roles' => $roles, 'likesDataComments' => $likesDataComments]);
    }

    public function createComment(Request $rqs, $id)
    {
        Comentario::create([
            'content' => $rqs->input('content'),
            'date_comment' => now(),
            'forum_id' => $id,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('forum.viewComments', ['id' => $id])->with('commentCreate', true);
    }

    public function updateCommentLikes(Request $rqs, $id, $comment)
    {
        $newLike = $rqs->input('newLike');

        $comentario = Comentario::find($comment);
        $user = Auth::user();

        $pivot = $comentario->likeUsuarios()->wherePivot('user_id', $user->id)->first();

        if ($newLike) {
            $comentario->likes += 1;

            if (!$pivot) {
                $comentario->likeUsuarios()->attach($user->id, ['has_like' => true]);
            } else {
                $comentario->likeUsuarios()->updateExistingPivot($user->id, ['has_like' => true]);
            }
        } else {
            if ($pivot) {
                $comentario->likeUsuarios()->updateExistingPivot($user->id, ['has_like' => false]);
                $comentario->likes = max(0, $comentario->likes - 1);
            }
        }

        $comentario->save();

        return response()->json(['success' => true, 'message' => 'Like actualizado correctamente']);
    }

    public function deletedComment($id, $comment)
    {
        $comentario = Comentario::find($comment);

        $comentario->delete();

        return redirect()->route("forum.viewComments", ['id' => $id])->with('postDeleted', true);
    }
}
