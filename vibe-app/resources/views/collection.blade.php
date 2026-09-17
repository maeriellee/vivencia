<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collection | Vivencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@600;700;800&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/vivencia-brown.css">
</head>
<body class="vivencia-shell">
    <main class="mx-auto max-w-[980px] px-4 py-12">
        <section class="vivencia-card p-7 md:p-10">
            <p class="font-bold uppercase tracking-[0.18em] text-primary">Collection</p>
            <h1 class="mt-2 font-[Epilogue] text-4xl font-extrabold">You are logged in, {{ $customer['name'] }}</h1>
            <p class="mt-3 text-on-surface-variant">Your successful order has been saved. Collection details and live updates are available in your dashboard.</p>
            <div class="mt-7 grid gap-4">
                @foreach ($orders as $order)
                    <article class="rounded-lg {{ $order['id'] === $lastOrderId ? 'bg-surface-container-high' : 'bg-surface-container-low' }} p-4">
                        <div class="flex flex-wrap justify-between gap-3"><strong>{{ $order['id'] }}</strong><span class="font-bold text-primary">{{ $order['payment_status'] }}</span></div>
                        <p class="mt-2 text-sm text-on-surface-variant">{{ $order['pickup_date'] }} · Wurzbach-Bandera Area 78238</p>
                    </article>
                @endforeach
            </div>
            <div class="mt-8 flex flex-wrap gap-3">
                <a class="vivencia-button" href="/customer/dashboard">Open Dashboard</a>
                <a class="vivencia-button secondary" href="/menu">Order More</a>
            </div>
        </section>
    </main>
</body>
</html>
