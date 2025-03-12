<!DOCTYPE html>
<html lang="ru">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&display=swap" rel="stylesheet">


    <!-- Основная иконка для разных устройств -->
    <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    <!-- Иконка для Apple устройств -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="owr" />

    <!-- Манифест сайта -->
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owr</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Анимация для мигающего символа _ */
        @keyframes blink {
            50% {
                opacity: 0;
            }
        }
        .blink {
            animation: blink 1.5s step-start infinite;
        }
    </style>
</head>
<body class="bg-light-background text-light-text" data-theme="light">

<!-- Главный контейнер с общим отступом -->
<div class="min-h-screen flex flex-col px-6 py-2">

    <!-- Навбар -->
    <header class="py-4">
        <nav class="flex justify-between items-center w-full">
            <div class="text-xl font-bold text-primary flex items-center space-x-2" id="theme-toggle">
                <!-- Логотип -->
                <img src="{{ asset('icons/owr.svg') }}" alt="Logo" class="w-6 h-6">
            </div>
        </nav>
    </header>


    <!-- Центральный блок -->
    <main class="flex-grow text-lg flex items-center justify-center py-10">
        <div class="w-full max-w-xl mx-auto space-y-16">
            <!-- Блок 1: Выбор роли персонажа -->
            <div class="flex justify-around">
                <!-- Кнопки выбора роли -->
                @foreach (['Tank', 'Damage', 'Support'] as $role)
                    <button class="buttonRole flex items-center space-x-2 pb-4 focus:outline-none">
                        <img src="{{ asset('icons/' . $role . '.svg') }}" alt="{{ $role }}" class="w-6 h-6">
                        <span>{{ $role }}</span>
                    </button>
                @endforeach
            </div>

            <!-- Блок 2: Большой квадратик для смены картинок -->
            <div class="w-full max-w-xl aspect-square bg-gray-200 rounded-[6rem] mx-auto">
                <!-- Здесь будут меняться картинки -->
            </div>

            <!-- Блок 3: Две кнопки -->
            <div class="flex justify-center space-x-4">
                <!-- Кнопка Shuffle -->
                <button class="buttonColor flex items-center px-6 py-3 bg-primary text-secondary font-bold rounded-lg shadow-lg transition hover:bg-zinc-800">
                    <img src="{{ asset('icons/Shuffle.svg') }}" alt="Shuffle Icon" class="w-5 h-5 mx-1">
                    <span>Shuffle</span>
                </button>
                <!-- Вторая кнопка -->
                <button class="buttonStroke flex items-center px-6 py-3 border text-primary rounded-lg">
                    <img src="{{ asset('icons/Check.svg') }}" alt="Check Icon" class="w-5 h-5 mx-1">
                </button>
            </div>
        </div>
    </main>

    <!-- Футер -->
    <footer class="py-4 text-xl">
        <div class="flex justify-between items-center w-full">
            <p class="text-primary">en</p>
            <p class="text-primary">info</p>
        </div>
    </footer>

</div>

<script>
    const themeToggleButton = document.getElementById('theme-toggle');

    themeToggleButton.addEventListener('click', () => {
        const currentTheme = document.body.getAttribute('data-theme');
        if (currentTheme === 'light') {
            document.body.setAttribute('data-theme', 'dark');
        } else {
            document.body.setAttribute('data-theme', 'light');
        }
    });
</script>

</body>
</html>
