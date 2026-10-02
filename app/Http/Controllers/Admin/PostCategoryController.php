<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PostCategoryController extends Controller
{
    public function index(): View
    {
        $categories = PostCategory::withCount('posts')->latest()->get();

        return view('admin.post-categories.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120|unique:post_categories,name',
            'slug' => 'nullable|string|max:120|unique:post_categories,slug',
            'description' => 'nullable|string|max:255',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        PostCategory::create($validated);

        return back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, PostCategory $post_category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120|unique:post_categories,name,'.$post_category->id,
            'slug' => 'nullable|string|max:120|unique:post_categories,slug,'.$post_category->id,
            'description' => 'nullable|string|max:255',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $post_category->update($validated);

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy(PostCategory $post_category): RedirectResponse
    {
        if ($post_category->posts()->count() > 0) {
            return back()->with('error', 'Cannot delete category that contains posts.');
        }

        $post_category->delete();

        return back()->with('success', 'Category deleted successfully.');
    }
}
