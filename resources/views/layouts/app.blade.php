<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Księgarnia')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            top: 70px;
            left: 0;
            width: 250px;
            background-color: #ffffff;
            border-right: 1px solid #ddd;
            padding: 20px;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 270px;
            padding: 20px;
        }

        button:focus, a:focus, [role="button"]:focus, [role="link"]:focus {
            outline: 3px solid #0056b3;
            outline-offset: 2px;
        }


        .zoomed {
            transform: scale(1.3); /* Powiększenie o 50% */
            transition: transform 0.3s ease;
        }
    </style>
    <script>
        let speechEnabled = false; // Flaga do włączania/wyłączania funkcji odczytu

        // Funkcja do odczytu tekstu na głos
        function speakText(text) {
            if (speechEnabled && 'speechSynthesis' in window) {
                window.speechSynthesis.cancel(); // Przerwij poprzednie odczytywanie
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'pl-PL'; // Polski język
                window.speechSynthesis.speak(utterance);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const increaseButton = document.getElementById('increase-text');
            const decreaseButton = document.getElementById('decrease-text');
            let currentFontSize = 16; // Domyślny rozmiar

            increaseButton.addEventListener('click', () => {
                currentFontSize += 2;
                document.body.style.fontSize = currentFontSize + 'px';
            });

            decreaseButton.addEventListener('click', () => {
                currentFontSize = Math.max(12, currentFontSize - 2); // Minimalny rozmiar to 12px
                document.body.style.fontSize = currentFontSize + 'px';
            });
        });

        // Automatyczne nasłuchiwanie na tekst elementów
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('button, a, label, input, h1, h2, h3, p, li');
            const toggleButton = document.getElementById('toggle-speech');

            // Funkcja przełączająca odczyt tekstu
            toggleButton.addEventListener('click', () => {
                speechEnabled = !speechEnabled;
                toggleButton.textContent = speechEnabled ? 'Wyłącz odczyt tekstu' : 'Włącz odczyt tekstu';

                // Anulowanie odczytywania, gdy funkcja jest wyłączona
                if (!speechEnabled) {
                    window.speechSynthesis.cancel();
                }
            });

            // Dodanie nasłuchiwania do elementów
            elements.forEach(element => {
                element.addEventListener('mouseover', () => {
                    let text = element.innerText || element.value || element.getAttribute('aria-label') || "Brak tekstu";
                    speakText(text.trim());
                });

                // Zatrzymanie odczytywania po opuszczeniu elementu
                element.addEventListener('mouseout', () => {
                    window.speechSynthesis.cancel();
                });
            });
        });


        document.addEventListener('DOMContentLoaded', () => {
            // Pobierz wszystkie przyciski oraz linki z klasą "btn"
            const buttons = document.querySelectorAll('button, a.btn');

            buttons.forEach(button => {
                // Dodaj efekt powiększenia po najechaniu myszką
                button.addEventListener('mouseover', () => {
                    button.classList.add('zoomed');
                });

                // Usuń efekt powiększenia po opuszczeniu myszką
                button.addEventListener('mouseout', () => {
                    button.classList.remove('zoomed');
                });
            });
        });


    </script>




</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Księgarnia</a>
        <div class="collapse navbar-collapse">
            <div class="text-end p-3">
                <button id="toggle-speech" class="btn btn-secondary">
                    Włącz odczyt tekstu
                </button>

            </div>
            <div class="text-end p-3">
                <button id="increase-text" class="btn btn-secondary">Zwiększ tekst</button>
                <button id="decrease-text" class="btn btn-secondary">Zmniejsz tekst</button>
            </div>
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
