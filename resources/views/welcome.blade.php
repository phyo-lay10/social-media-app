@extends('layouts.master')
@section('content')

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session()->get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session()->get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row d-flex justify-content-between">
        <div class="col-md-4">
            @if (Auth::check())
            <form action="{{isset($post->id) ? route('posts.update',$post->id) : route('posts.store',$post->id)}}" method="POST" class="border shadow p-4 rounded mb-5">@csrf @if (isset($post->id)) @method('put') @endif
                <div class="mb-3">
                    <label for="title" class="mb-1"><b>Title</b></label>
                    <input type="text" value="{{ isset($post->id) ? old('name', $post->title) : old('title') }}"  name="title" id="title" class="form-control shadow bg-transparent @error('title') is-invalid @enderror" placeholder="Enter post title">
                    @error('title')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="body" class="mb-1"><b>Body</b></label>
                    <textarea name="body" id="body" class="form-control bg-transparent shadow @error('body') is-invalid @enderror" placeholder="Enter post body" rows="5">{{ isset($post->id) ? old('name', $post->title) : old('body') }}</textarea>
                    @error('body')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <div>
                    <button class="btn btn-sm btn-primary shadow">
                        {{isset($post->id) ? 'Update' : 'Create'}}
                    </button>
                </div>
            </form>
            @endif
        </div>

        <div class="col-md-7">
            @if ($posts->isEmpty())
                <p class="mt-3 fw-bold fs-5">No posts available at the moment.</p>
            @else

            @foreach ($posts as $post)
            <div class="card bg-transparent shadow border-0 mb-4 pt-2">
                <div class="card-header d-flex justify-content-between bg-transparent border-0">
                    <h4 class="mb-3">{{$post->title}}</h4>
                    <h6>{{$post->user->name}}</h6>
                </div>
                <div class="card-body">
                    <p>{{$post->body}}</p>
                </div>
                <div class="card-footer bg-transparent border-0 clearfix">
                    <p class="float-start text-success fw-bold ">{{$post->created_at->diffForHumans()}}</p>
                    <div class="dropdown">
                        <button class="btn btn-sm shadow border-0 float-end" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu">
                        @if(Auth::check() && $post->user_id === Auth::user()->id)
                            <form action="{{route('posts.destroy', $post->id)}}" method="POST"> @csrf @method('delete')
                                <li><a class="dropdown-item" href="{{route('posts.edit', $post->id)}}">Edit</a></li>
                                <li><button class="dropdown-item" onclick="return confirm('Are u sure to delete?')">Delete</button></li>
                            </form>
                        @endif
                        <li><a class="dropdown-item" href="{{route('posts.show', $post->id)}}">Detail</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            @endforeach
            @endif
        </div>
    </div>
@endsection



