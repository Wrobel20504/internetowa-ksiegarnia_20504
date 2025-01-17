<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Księgarnia')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Jasny szary */
        }
        .navbar {
            background-color: #007bff; /* Niebieski */
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .card {
            border: 1px solid #007bff;
        }
        .card-title {
            color: #007bff;
        }
        .footer {
            background-color: #007bff;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Księgarnia</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Logowanie</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Rejestracja</a></li>
                @else
                    <li class="nav-item"><span class="nav-link">Zalogowano jako: {{ Auth::user()->name }} ({{ Auth::user()->role }})</span></li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="cursor: pointer;">Wyloguj</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    @yield('content')
</div>
<footer class="footer">
    <div class="container">
        <p>&copy; {{ date('Y') }} Księgarnia Internetowa. Wszystkie prawa zastrzeżone.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
