<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $query = Post::with(['category', 'author'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('post_category_id', $request->category);
        }

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                    ->orWhere('excerpt', 'like', '%' . $request->q . '%');
            });
        }

        $posts = $query->paginate(15)->withQueryString();
        $categories = PostCategory::orderBy('name')->get();

        $counts = [
            'all' => Post::count(),
            'published' => Post::where('status', 'published')->count(),
            'draft' => Post::where('status', 'draft')->count(),
        ];

        return view('admin.posts.index', compact('posts', 'categories', 'counts'));
    }

    public function create(): View
    {
        $categories = PostCategory::orderBy('name')->get();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatePost($request);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('posts', 'public');
        }

        $data['user_id'] = auth()->id();
        $data['slug'] = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($data['title']) . '-' . Str::random(6);

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post): View
    {
        $categories = PostCategory::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $this->validatePost($request, $post->id);

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image && ! Str::startsWith($post->cover_image, ['http://', 'https://', '/images/'])) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('posts', 'public');
        }

        if ($request->filled('slug')) {
            $data['slug'] = Str::slug($request->slug);
        }

        if ($data['status'] === 'published' && empty($post->published_at) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        if ($post->cover_image && ! Str::startsWith($post->cover_image, ['http://', 'https://', '/images/'])) {
            Storage::disk('public')->delete($post->cover_image);
        }

        $post->delete();

        return back()->with('success', 'Post deleted successfully.');
    }

    protected function validatePost(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'title' => 'required|string|max:200',
            'slug' => 'nullable|string|max:200|unique:posts,slug,' . $id,
            'post_category_id' => 'nullable|exists:post_categories,id',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'cover_image' => 'nullable|image|max:4096',
        ]);
    }
}
