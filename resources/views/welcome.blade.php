<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Developer Portfolio CMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-2xl mx-auto mt-20 text-center">
        <h1 class="text-4xl font-bold mb-4">👋 Welcome to Your Portfolio CMS</h1>
        <p class="text-lg">Login or Register to start adding your projects.</p>
        <div class="mt-6">
            <a href="{{ route('login') }}" class="text-blue-600 underline">Login</a> |
            <a href="{{ route('register') }}" class="text-blue-600 underline">Register</a>
        </div>
    </div>
</body>
</html>
