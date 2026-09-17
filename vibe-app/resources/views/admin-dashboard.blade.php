<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="30">
    <title>Admin Dashboard | Vivencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@600;700;800&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/vivencia-brown.css">
</head>
<body class="vivencia-shell">
    <header class="border-b border-primary-container/20 bg-surface-container-lowest">
        <div class="mx-auto flex max-w-[1180px] items-center justify-between px-4 py-4">
            <strong class="font-[Epilogue] text-2xl text-primary">Vivencia Admin</strong>
            <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="vivencia-button secondary" type="submit">Logout</button></form>
        </div>
    </header>
    <main class="mx-auto grid max-w-[1180px] gap-6 px-4 py-8">
        <section class="grid gap-4 md:grid-cols-3">
            <div class="vivencia-card p-5"><div class="text-sm text-on-surface-variant">Orders</div><strong class="text-3xl">{{ count($orders) }}</strong></div>
            <div class="vivencia-card p-5"><div class="text-sm text-on-surface-variant">Customers</div><strong class="text-3xl">{{ count($customers) }}</strong></div>
            <div class="vivencia-card p-5"><div class="text-sm text-on-surface-variant">Refresh</div><strong class="text-3xl">30s</strong></div>
        </section>
        <section class="vivencia-card p-6">
            <h1 class="font-[Epilogue] text-3xl font-extrabold">Orders</h1>
            <div class="mt-5 grid gap-4">
                @forelse ($orders as $order)
                    <article class="rounded-lg bg-surface-container-low p-4">
                        <div class="flex flex-wrap justify-between gap-3"><strong>{{ $order['id'] }}</strong><span class="font-bold text-primary">{{ $order['status'] }}</span></div>
                        <div class="mt-2 text-sm text-on-surface-variant">{{ $order['customer_email'] }} · ${{ number_format($order['subtotal'], 2) }} · {{ $order['payment_method'] }}</div>
                    </article>
                @empty
                    <p>No orders yet.</p>
                @endforelse
            </div>
        </section>
    </main>
</body>
</html>
