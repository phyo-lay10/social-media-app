<!-- resources/views/comment/edit.blade.php -->
@extends('layouts.master')

@section('content')
    <div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold">Edit Comment</h5>
            <div>
                <a href="{{route('index')}}" class="my-3 btn btn-sm btn-primary" title="back"><i class="fa-solid fa-rotate-right"></i></a>
            </div>
        </div>

        @if (session()->has('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="w-50">
            @csrf
            @method('PUT')
            <div class="form-group">
                <textarea class="form-control border-dark" id="text" name="text" rows="3">{{old('text') ?? $comment->text }}</textarea>
                @error('text')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-sm btn-primary mt-3">Update</button>
            </div>
        </form>
    </div>
@endsection
