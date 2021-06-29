@extends('layouts.app')

@section('title', $post->title )
    
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if ($post->thumbnail)
                    <img style="height: 550px; object-fit: cover; object-position: center;" 
                        class="rounded w-100" src="{{ $post->takeImage }}">
                @endif

                <div class="mt-2">
                    <h1>{{ $post->title }}</h1>
                </div>
                <div class="text-secondary mb-3">
                <a href="/categories/{{ $post->category->slug}}" style="text-decoration:none">{{            $post->category->name }}</a>   
                &middot; {{$post->created_at->format("d F, Y")}}
                &middot;
                @foreach ($post->tags as $tag) 
                    <a href="/tags/{{ $tag->slug }}" style="text-decoration:none">#{{$tag->name}}</a>
                @endforeach

                    <div class="media my-3">
                        <img width="60" class="rounded-circle mr-3" src="{{ $post->author->gravatar()}}" alt="">  
                        <div class="media-body">
                            <div>
                                {{ $post->author->name}}

                            </div>
                            <div>
                                {{ '@' . $post->author->username}}
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                <hr>
                <p>{!! nl2br($post->body) !!}</p>
                <div>
                    
                    {{-- @if (auth()->user()->id == $post->user_id) --}}
                    {{-- @if (auth()->user()->is($post->author)) --}}
                    @can('delete', $post)
                    <div class="d-flex mt-3 p-2">
                        {{-- @if(auth()->user()->is($post->author)) --}}
                        {{-- @can('update', $post) --}}
                        <a href="/posts/{{ $post->slug }}/edit" class="btn btn-sm btn-success mr-2">Edit</a>
                        {{-- @endcan --}}
                        {{-- @endif --}}
                            <!-- Button trigger modal -->        
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Delete
                        </button>
                    </div>
                
                        <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin menghapus postingan ini ?</h5>
                                            
                            </div>
                            <div class="modal-body">
                                <div class="my-2">
                                    <div>
                                        <h5>{{ $post->title }}</h5>
                                    </div>
                                    <div class="text-secondary">
                                        <small>
                                            Published : {{ $post->created_at->format("d F, Y")}}
                                        </small>
                                    </div>
                                </div>
                                <form action="/posts/{{ $post -> slug }}/delete" method="post">
                                    @csrf
                                    @method("delete")
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-danger mx-3" type="submit">Ya</button>
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Tidak</button>
                                    </div>
                                </form>
                            </div>
                            {{-- <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                    @endcan
                    {{-- @endif --}}
                </div>
            </div>

            <div class="col-md-4">
                @foreach ($posts as $post)
                <div class="card mb-4">
                    {{-- @if ($post->thumbnail)
                        <a href="{{ route('posts.show', $post->slug)}}">
                            <img style="height: 400px; object-fit: cover; object-position: center;" 
                                 class="card-img-top" src="{{ $post->takeImage }}">
                        </a> 
                    @endif --}}

                    <div class="card-body">
                        <div>
                            <a href="{{ route('categories.show', $post->category->slug)}}" class="text-secondary">
                            <small>
                                {{$post->category->name}} -
                            </small>
                            </a>

                            @foreach ($post->tags as $tag)
                            <a href="{{ route('tags.show', $tag->slug)}}" class="text-secondary">
                                <small>
                                    #{{$tag->name}}
                                </small>
                                </a>
                            @endforeach
                        </div>
                        
                        <a class="text-dark" href="{{ route('posts.show', $post->slug)}}" class="card-title">
                            <h5>{{ $post->title }}</h5>
                        </a>
                        <div class="text-secondary my-3">
                        {{ Str::limit($post->body, 140, '.') }}
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            
                                <div class="media align-items-center">
                                    <img width="40" class="rounded-circle mr-3" src="{{ $post->author->gravatar()}}" alt="">  
                                    <div class="media-body">
                                        <div>
                                            {{ $post->author->name}}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-secondary">
                                    <small>
                                        Published on {{ $post->created_at->diffForHumans() }}
    
                                    </small>
                                </div>
                                
                        </div>
                        

                        {{-- <a href="/posts/{{ $post->slug }}">Read More</a> --}}
                    </div>
                    
                        {{-- Published on {{ $post->created_at->format("d F, Y") }} menampilkan format d m y --}}
                        
                    
                </div>
                @endforeach
            </div>
        </div>

        
    </div>

@endsection