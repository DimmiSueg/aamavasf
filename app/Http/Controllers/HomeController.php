<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home', [
            'events' => Event::upcoming()->limit(4)->get(),
            'posts' => Post::published()->limit(3)->get(),
        ]);
    }

    public function blog(): Response
    {
        return Inertia::render('Blog', [
            'posts' => Post::published()->paginate(12),
        ]);
    }

    public function post(string $slug): Response
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        return Inertia::render('BlogPost', ['post' => $post]);
    }
}
