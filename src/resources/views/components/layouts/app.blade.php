<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Restoran</title>
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="container mx-auto">
        {{ $slot }}
    </div>

    @livewireScripts
</body>
</html>
