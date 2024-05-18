<?php

namespace App\Http\Controllers\API;

use App\Helpers\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return JsonResponse::success(Auth::user()->comments, 'Success', 200);
    }

    public function commentsInPost(string $id)
    {
        $post = Post::find($id);
        return JsonResponse::success($post->comments, 'Success', 200);
    }


    public function store(CommentRequest $request)
    {
        $user = Auth::user();

        $comment = Comment::create([
            'post_id' => $request->input('post_id'),
            'user_id' => $user->id,
            'content' => $request->input('content'),
        ]);

        return JsonResponse::success($comment, 'Created successfuly', 200);
    }

    public function update(CommentRequest $request, string $id)
    {
        $comment = Comment::findOrFail($id);

        // Verificar que el comentario pertenece al usuario autenticado
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Comment not found or access denied'], 404);
        }

        $comment->update([
            'content' => $request->content,
        ]);

        return JsonResponse::success($comment, 'Updated successfuly', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);

        // Verificar que el comentario pertenece al usuario autenticado
        if ($comment->user_id !== Auth::id()) {
            return JsonResponse::error('Coment doesnt exist', 404);
        }

        $comment->delete();
        return JsonResponse::success($comment, 'Deleted successfuly', 200);
    }
}
