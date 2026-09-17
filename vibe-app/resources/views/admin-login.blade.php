<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Vivencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@600;700;800&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/vivencia-brown.css">
</head>
<body class="vivencia-shell">
    <main class="grid min-h-screen place-items-center px-4">
        <form class="vivencia-card w-full max-w-md p-7" method="POST" action="{{ route('admin.authenticate') }}">
            @csrf
            <h1 class="font-[Epilogue] text-3xl font-extrabold">Admin Login</h1>
            <p class="mt-2 text-on-surface-variant">Whitelisted staff access. No public registration.</p>
            @if (session('error')) <div class="mt-4 rounded-lg bg-red-50 p-3 text-sm text-red-700">{{ session('error') }}</div> @endif
            <label class="mt-6 grid gap-2 text-sm font-bold">Email<input class="vivencia-input" name="email" type="email" required></label>
            <label class="mt-4 grid gap-2 text-sm font-bold">Password<input class="vivencia-input" name="password" type="password" required></label>
            <button class="vivencia-button mt-6 w-full" type="submit">Enter Admin</button>
            <p class="mt-4 text-xs text-on-surface-variant">Demo credentials: admin@vivencia.local / VivenciaAdmin2026!</p>
        </form>
    </main>
</body>
</html>
