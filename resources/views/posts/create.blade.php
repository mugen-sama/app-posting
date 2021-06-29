@extends('layouts.app', ['title' => 'New Post']) 
{{-- create dinamic title dengan set title = New Post --}}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">New Post</div>
                <div class="card-body">
                    <form action="/posts/store" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @include('posts.partials.form-control', ['submit' => 'Create'] )
                        {{-- create dinamic button dengan men set submit button = Create --}}

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@stop