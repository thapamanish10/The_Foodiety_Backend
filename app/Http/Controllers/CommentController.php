<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Blog;  // Changed from Post to Blog to match your setup
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'post_id' => 'required|exists:blogs,id',
            'parent_id' => 'nullable|exists:comments,id',
            'is_admin_reply' => 'nullable|boolean'
        ]);

        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->user_id = auth()->id();
        $comment->post_id = $validated['post_id'];
        $comment->parent_id = $validated['parent_id'] ?? null;
        
        // Mark as admin reply if user is admin and checkbox was selected
        $comment->is_admin_reply = auth()->user()->is_admin && ($validated['is_admin_reply'] ?? false);
        
        $comment->save();

        return back()->with('success', 'Comment posted successfully!');
    }
    
    /**
     * Delete the specified comment.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        
        // Delete all replies first if this is a parent comment
        if ($comment->replies()->count() > 0) {
            $comment->replies()->delete();
        }
        
        $comment->delete();
        
        return back()->with('success', 'Comment deleted successfully!');
    }
    
    /**
     * Get comments for a blog post with replies.
     */
    public function getComments(Blog $blog)
    {
        $comments = $blog->comments()
                        ->whereNull('parent_id')
                        ->with(['user', 'replies.user'])
                        ->latest()
                        ->get();

        return view('blogs.show', compact('blog', 'comments'));
    }
}