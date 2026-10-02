<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        NewsletterSubscriber::updateOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'] ?? null,
                'source' => $request->input('source', 'website'),
                'is_active' => true,
                'unsubscribed_at' => null,
            ]
        );

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }

    public function unsubscribe(string $email): RedirectResponse
    {
        $subscriber = NewsletterSubscriber::where('email', $email)->first();

        if ($subscriber) {
            $subscriber->unsubscribe();
        }

        return redirect()->route('home')->with('info', 'You have been unsubscribed from our newsletter.');
    }
}
