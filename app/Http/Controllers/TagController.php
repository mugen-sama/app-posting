<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->latest()->paginate(3);
        return view('posts.index', compact('posts', 'tag'));
    }
}
