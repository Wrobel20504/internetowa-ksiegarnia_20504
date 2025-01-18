<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Księgarnia')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .footer {
            background-color: #007bff;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            margin-top: 20px;
        }
        .card {
            margin-bottom: 20px;
        }

        .card-header {
            font-weight: bold;
        }

        .form-label {
            font-size: 14px;
            color: #495057;
        }
        .sidebar {
            position: absolute;
            top: 70px; /* Odstęp od góry, np. od paska nawigacji */
            left: 0;
            width: 250px; /* Szerokość panelu bocznego */
            background-color: #ffffff; /* Kolor tła */
            border-right: 1px solid #ddd; /* Linia oddzielająca */
            padding: 20px;
            overflow-y: auto; /* Dodaj przewijanie, jeśli zawartość jest za długa */
        }

        .main-content {
            margin-left: 270px; /* Margines, aby uwzględnić szerokość panelu bocznego */
            padding: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Księgarnia</a>
        <div class="collapse navbar-collapse">
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
