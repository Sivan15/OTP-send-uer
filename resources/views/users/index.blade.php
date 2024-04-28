<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@include('layouts.nav')
<body>
<div class="flex justify-center items-center w-11/12 mx-20">
<div class="container mx-auto">
    <h1 class="text-xl font-bold my-4">All Users</h1>
    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2">S.NO</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">mobile</th>
                <th class="px-4 py-2">image</th>
                <!-- Add other headers as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="border px-4 py-2">{{ $user->id }}</td>
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                <td class="border px-4 py-2">{{ $user->mobile }}</td>
                <td class="border px-4 py-2">{{ $user->image }}</td>
                <!-- Add other user details as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</body>
</html>