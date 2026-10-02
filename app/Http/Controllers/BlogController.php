<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $categories = PostCategory::whereHas('posts', function ($q) {
            $q->published();
        })->withCount(['posts' => function ($q) {
            $q->published();
        }])->get();

        $query = Post::published()->with(['category', 'author'])->latest('published_at');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $posts = $query->paginate(9)->withQueryString();
        $featuredPost = $posts->first();

        return view('pages.blog.index', compact('posts', 'categories', 'featuredPost'));
    }

    public function show(string $slug): View
    {
        $post = Post::with(['category', 'author'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Only allow unpublished post preview if logged in admin
        if (! $post->isPublished()) {
            if (! auth()->check() || ! auth()->user()->isAdmin()) {
                abort(404);
            }
        } else {
            $post->increment('views');
        }

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where('post_category_id', $post->post_category_id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.blog.show', compact('post', 'relatedPosts'));
    }
}
