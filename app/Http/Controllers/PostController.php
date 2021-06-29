<?php

namespace App\Http\Controllers;

use App\Models\{Post, Category, Tag};

use Illuminate\Support\Str;
use App\Http\Requests\PostRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except([
    //         'index', 'show'
    //     ]);
    // } 
    //hapus middleware, ganti taruh di route agar lebih simpel 

    public function index()
    {
        // $posts = Post::take(2)->get();
        
        // $posts = Post::simplePaginate(2);
        // return view('posts.index', ['posts' => $posts]);
       
        return view('posts.index', [
            'posts' => Post::latest()->simplePaginate(6)
            ]);
    }

    public function show(Post $post)
    {
        $posts = Post::where('category_id', $post->category_id)->latest()->limit(3)->get();
        return view('posts.show', compact('post', 'posts'));
    }

    public function create()
    {
        return view('posts.create', [
            'post' => new Post(),
            'categories' => Category::get(),
            'tags' => Tag::get(),
            ]);
    }

    public function store(PostRequest $request)
    {
        //membuat variabel attr untuk validasi form yg harus diisi
        // $attr = $this->validateRequest();
        $attr = $request->all();
        
        //mengkonversi title menjadi slug
        $slug = Str::slug(request()->input('title'), "-");
        $attr['slug'] = $slug;
        
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,jpg,png,svg|max:4096'
        ]);

        // if (request()->file('thumbnail')) {
        //     $thumbnail = request()->file('thumbnail')->store("images/posts");
        // }   else {
        //      $thumbnail = null ;
        // }

        $thumbnail = request()->file('thumbnail') ? request()->file('thumbnail')->store("images/posts") : null ;
        //create category
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;

        // $attr['user_id'] = auth()->id();
        //create post
        // $post = Post::create($attr);
        $post = auth()->user()->posts()->create($attr);
        //create tag
        $post->tags()->attach(request('tags'));

        session()->flash('success', 'Postingan anda bershasil dibuat !');
        // session()->flash('error', 'Maaf postingan anda gagal dibuat :(');

        return redirect('posts');
        // return back();
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get(),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        //authorize post
        $this->authorize('update', $post);
        //validate the field
        // $attr = $this->validateRequest();
        $attr = $request->all();

        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,jpg,png,svg|max:4096'
        ]);
        
        if (request()->file('thumbnail')) {
            Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("images/posts");
        } else {
            $thumbnail = $post->thumbnail;
        }
        
        //update category ke db
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;

        // //POST Update
        // Post::update($attr);
        $post->update($attr);
        //update tag ke db
        $post->tags()->sync(request('tags'));
        //alert berhasil update
        session()->flash('success', 'Postingan anda bershasil di update !');
        //return ke halaman posts
        return redirect('posts');
    }

    public function destroy (Post $post)
    {
    //     if (auth()->user()->is($post->author)) {
    //         $post->tags()->detach();
    //         $post -> delete();
    //         session()->flash("success", "Postingan Anda Berhasil Dihapus !");
    //         return redirect('posts');
    //     } else {
    //         session()->flash("error", "Maaf ini bukan postingan anda !");
    //         return redirect('posts');   
    //     }

            $this->authorize('delete', $post);
            Storage::delete($post->thumbnail);

            $post->tags()->detach();
            $post->delete();
            session()->flash("success", "Postingan Anda Berhasil Dihapus !");
            return redirect('posts');
    }

    // public function validateRequest()
    // {
    //     return request()->validate([
    //         'title' => 'required|min:3',
    //         'body' => 'required'
    //     ]);
    // }

}
