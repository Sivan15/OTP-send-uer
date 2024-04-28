<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- <link href="{{ asset('resources/css/app.css') }}" rel="stylesheet"> -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
   @include('layouts.adminnav')
<body class="bg-gray-100">
<div class="container mx-auto p-4">
    <h2 class="text-2xl mb-4">Signup</h2>
    <form action="{{ route('admin.store') }}" method="post" class="max-w-md mx-auto">
        @csrf
        <div class="mb-4">
            <label for="name" class="block">Name:</label>
            <input type="text" id="name" name="name" class="border rounded w-full p-2">
        </div>
        <div class="mb-4">
            <label for="email" class="block">Email:</label>
            <input type="email" id="email" name="email" class="border rounded w-full p-2">
        </div>
        <div class="mb-4">
            <label for="mobile" class="block">Mobile Number:</label>
            <input type="text" id="mobile" name="mobile" class="border rounded w-full p-2">
        </div>
        <div class="mb-4">
            <label for="image" class="block">Upload Image:</label>
            <input type="file" id="image" name="image" class="border rounded w-full p-2">
        </div>
        <div class="mb-4">
            <label for="password" class="block">Password:</label>
            <input type="password" id="password" name="password" class="border rounded w-full p-2">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Signup</button>
    </form>
</div>

</body>
</html>