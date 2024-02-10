@extends('auth.master')
@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-md-4">
        <form action="{{route('register.store')}}" method="post"> @csrf
            <h4 class="mt-5 mb-4"><b>Register Form</b></h4>
            <div class="card card-body mt-3 p-4 shadow border-0" style="background-color: white">
                <div class="mb-3">
                    <label for="name" class="mb-2"><b>Name</b></label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control border-0 shadow @error('name') is-invalid @enderror" id="name" placeholder="Enter your name">
                    @error('name')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="mb-2"><b>Email</b></label>
                    <input type="text" name="email"  value="{{old('email')}}" class="form-control border-0 shadow @error('email') is-invalid @enderror" id="email" placeholder="Enter your email">
                    @error('email')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="mb-2"><b>Password</b></label>
                    <input type="password" name="password"  value="{{old('password')}}" class="form-control border-0 shadow @error('password') is-invalid @enderror" id="password" placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div class="my-2">
                    <button class="btn btn-sm btn-primary shadow mb-3">Submit</button>
                    <div>Already have an account? <a href="{{route('loginForm')}}"><b> Login here</b></a></div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
