@extends('layouts.master')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold">Detail Page</h5>
        <div>
            <a href="{{route('index')}}" class="my-3 btn btn-sm btn-primary" title="back"><i class="fa-solid fa-rotate-right"></i></a>
        </div>
    </div>

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session()->get('error')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-7">
            <div class="card bg-transparent shadow border-0 card-body">
                <div class="d-flex justify-content-between mb-2">
                    <p><b>Title</b> : {{$post->title}}</p>
                    <h6>{{$post->user->name}}</h6>
                </div>

                <p><b>Body</b> : {{$post->body}}</p>
                <div class="mt-3">
                    <p class="float-start text-success fw-bold ">{{$post->created_at->diffForHumans()}}</p>
                    <button class="btn btn-primary shadow float-end  btn-sm" type="button"data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        View Comment <span class="badge bg-white text-dark ms-2">{{count($comments)}}</span>
                    </button>
                </div>
            </div>
            <div class="collapse my-3" id="collapseExample">
                <div class="w-50">
                    <form action="{{route('comment', $post->id)}}" method="POST"> @csrf
                        <textarea class="form-control shadow mb-2" required  name="text" rows="4" placeholder="comment here"></textarea>
                        <button class="btn btn-sm shadow btn-primary">Comment</button>
                    </form>
                </div>
                <div class="mt-2 card card-body">
                    @if ($comments->isEmpty())
                        <p class="text-center fw-bold ">No comment found !</p>
                    @else
                        @foreach ($comments as $comment)
                        <div class="">
                            <p>User : <b>{{$comment->user->name}}</b></p>
                            <p>{{$comment->text}}</p>
                            <form action="{{route('comments.delete', $comment->id)}}" method="POST" class="d-flex justify-content-end gap-2"> @csrf @method('delete')
                                <a href="{{route('comments.edit', $comment->id)}}" class="btn btn-sm btn-success" title="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                <button class="btn btn-sm btn-danger" title="delete" onclick="return confirm('Are u sure to delete?')"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
