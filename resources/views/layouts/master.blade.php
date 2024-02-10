<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social Media</title>

    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        nav {
            background-color: lavender;
            box-shadow: 3px 3px 8px rgb(174, 173, 173);
        }
    </style>
</head>
<body style="background-color: whitesmoke">

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('index')}}"><i>Social-Media</i></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            </ul>
            <ul class="navbar-nav">
                @if (Auth::check())
                    <form action="{{route('logout')}}" method="POST" class="d-flex align-items-center gap-3"> @csrf
                        <div>
                            <li class="nav-item"><b>{{Auth::user()->name}}</b></li>
                        </div>
                        <button class="btn btn-sm btn-danger" title="logout" onclick="return confirm('Are u sure to logout?')">
                            {{-- <i class="fa-solid fa-right-from-bracket fs-5"></i> --}}
                            <i class="fa-solid fa-power-off"></i>
                        </button>
                    </form>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('loginForm')}}">SignIn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('registerForm')}}">SignUp</a>
                    </li>
                @endif
            </ul>
          </div>
        </div>
    </nav>

   <div class="container my-5">
        @yield('content')
   </div>

   {{-- fontawesome js --}}
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
   {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
