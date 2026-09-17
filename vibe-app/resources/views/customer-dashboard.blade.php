<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="30">
    <title>Dashboard | Vivencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@600;700;800&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/vivencia-brown.css">
</head>
<body class="vivencia-shell">
    <header class="border-b border-primary-container/20 bg-surface-container-lowest">
        <div class="mx-auto flex max-w-[1180px] items-center justify-between px-4 py-4">
            <a class="flex items-center gap-3" href="/"><img class="h-12 w-12 rounded-full object-contain" src="/images/menu/vivencia-logo.jpeg" alt="Vivencia logo"><strong class="font-[Epilogue] text-2xl text-primary">Vivencia</strong></a>
            <form method="POST" action="{{ route('customer.logout') }}">@csrf<button class="vivencia-button secondary" type="submit">Logout</button></form>
        </div>
    </header>
    <main class="mx-auto grid max-w-[1180px] gap-6 px-4 py-8 lg:grid-cols-[360px_1fr]">
        <section class="vivencia-card h-fit p-6">
            <h1 class="font-[Epilogue] text-3xl font-extrabold">Account Details</h1>
            @if (session('success')) <div class="mt-4 rounded-lg bg-green-50 p-3 text-sm text-green-800">{{ session('success') }}</div> @endif
            <form class="mt-5 grid gap-4" method="POST" action="{{ route('customer.profile.update') }}">
                @csrf
                <label class="grid gap-2 text-sm font-bold">Name<input class="vivencia-input" name="name" value="{{ $customer['name'] }}" required></label>
                <label class="grid gap-2 text-sm font-bold">Email<input class="vivencia-input" value="{{ $customer['email'] }}" disabled></label>
                <label class="grid gap-2 text-sm font-bold">Phone<input class="vivencia-input" name="phone" value="{{ $customer['phone'] }}" required></label>
                <label class="grid gap-2 text-sm font-bold">New password<input class="vivencia-input" name="password" type="password" placeholder="Leave blank to keep current"></label>
                <button class="vivencia-button" type="submit">Save info</button>
            </form>
        </section>
        <section class="grid gap-6">
            <div class="vivencia-card p-6">
                <p class="font-bold uppercase tracking-[0.18em] text-primary">Real time overview</p>
                <h2 class="mt-2 font-[Epilogue] text-3xl font-extrabold">Welcome, {{ $customer['name'] }}</h2>
                <div class="mt-5 grid gap-3 md:grid-cols-3">
                    <div class="rounded-lg bg-surface-container-low p-4"><div class="text-sm text-on-surface-variant">Orders</div><strong class="text-2xl">{{ count($orders) }}</strong></div>
                    <div class="rounded-lg bg-surface-container-low p-4"><div class="text-sm text-on-surface-variant">Latest status</div><strong>{{ $orders[0]['status'] ?? 'No orders yet' }}</strong></div>
                    <div class="rounded-lg bg-surface-container-low p-4"><div class="text-sm text-on-surface-variant">Auto refresh</div><strong>30 sec</strong></div>
                </div>
            </div>
            <div class="vivencia-card p-6">
                <h2 class="font-[Epilogue] text-2xl font-bold">Collection & Orders</h2>
                <div class="mt-5 grid gap-4">
                    @forelse ($orders as $order)
                        <article class="rounded-lg bg-surface-container-low p-4">
                            <div class="flex flex-wrap justify-between gap-3"><strong>{{ $order['id'] }}</strong><span class="font-bold text-primary">{{ $order['status'] }}</span></div>
                            <div class="mt-2 text-sm text-on-surface-variant">Pickup: {{ $order['pickup_date'] }} · Deposit: ${{ number_format($order['deposit'], 2) }}</div>
                            <ul class="mt-3 grid gap-1 text-sm">
                                @foreach ($order['items'] as $item)
                                    <li>{{ $item['quantity'] }} x {{ $item['name'] }}</li>
                                @endforeach
                            </ul>
                        </article>
                    @empty
                        <p class="text-on-surface-variant">No orders yet. Your paid orders will appear here in real time.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
</body>
</html>
