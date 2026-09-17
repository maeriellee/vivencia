<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page }} | Vivencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@600;700;800&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/vivencia-brown.css">
</head>
<body class="vivencia-shell">
    <main class="grid min-h-screen place-items-center px-4 text-center">
        <section class="vivencia-card max-w-xl p-8">
            <img class="mx-auto h-20 w-20 rounded-full object-contain" src="/images/menu/vivencia-logo.jpeg" alt="Vivencia logo">
            <p class="mt-5 font-bold uppercase tracking-[0.18em] text-primary">{{ $page }}</p>
            <h1 class="mt-2 font-[Epilogue] text-4xl font-extrabold">Under construction</h1>
            <p class="mt-3 text-on-surface-variant">This page is being prepared. For now, the menu, order, payment, dashboard, and admin flows are active.</p>
            <div class="mt-6 flex flex-wrap justify-center gap-3">
                <a class="vivencia-button" href="/menu">Open Menu</a>
                <a class="vivencia-button secondary" href="/">Home</a>
            </div>
        </section>
    </main>
</body>
</html>
