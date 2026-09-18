<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order | Vivencia</title>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@600;700;800&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/vivencia-brown.css">
</head>
<body class="vivencia-shell">
    <header class="bg-surface-container-lowest/95 border-b border-primary-container/20">
        <div class="mx-auto flex h-20 max-w-[1280px] items-center justify-between px-4 md:px-8 lg:px-12">
            <a href="/" class="flex items-center gap-3">
                <img class="h-12 w-12 rounded-full bg-white object-contain" src="/images/menu/vivencia-logo.jpeg" alt="Vivencia Heritage Bakery Logo">
                <div>
                    <div class="font-[Epilogue] text-2xl font-bold text-primary">Vivencia</div>
                    <div class="text-xs font-bold uppercase tracking-[0.18em] text-on-surface-variant">Bread · Cake · Delicacy</div>
                </div>
            </a>
            <nav class="hidden flex-wrap gap-5 text-sm font-bold uppercase tracking-wide md:flex">
                <a class="text-on-surface-variant hover:text-primary" href="/">Home</a>
                <a class="text-on-surface-variant hover:text-primary" href="/menu">Menu</a>
                <a class="text-on-surface-variant hover:text-primary" href="/gallery">Gallery</a>
                <a class="text-on-surface-variant hover:text-primary" href="/about">About</a>
                <a class="text-on-surface-variant hover:text-primary" href="/contact">Contact</a>
                <a class="text-on-surface-variant hover:text-primary" href="/customer/dashboard">Dashboard</a>
            </nav>
        </div>
    </header>

    <main class="mx-auto grid max-w-[1180px] gap-6 px-4 py-10 lg:grid-cols-[1fr_380px]">
        <section class="vivencia-card p-6 md:p-8">
            <p class="font-bold uppercase tracking-[0.18em] text-primary">Secure your bake slot</p>
            <h1 class="mt-2 font-[Epilogue] text-4xl font-extrabold">Review your order</h1>
            <p class="mt-3 max-w-2xl text-on-surface-variant">Create a customer password here. After payment, your order will be saved to your private dashboard and you will be redirected to collection while already logged in.</p>

            @if (session('error'))
                <div class="mt-5 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">{{ session('error') }}</div>
            @endif

            <form class="mt-8 grid gap-5" method="POST" action="{{ route('payment') }}" id="order-form">
                @csrf
                <input type="hidden" name="items" id="items-input" value="[]">

                <div class="grid gap-5 md:grid-cols-2">
                    <label class="grid gap-2 text-sm font-bold">Full name
                        <input class="vivencia-input" name="name" required value="{{ old('name', $customer['name'] ?? '') }}">
                    </label>
                    <label class="grid gap-2 text-sm font-bold">Email
                        <input class="vivencia-input" name="email" type="email" required value="{{ old('email', $customer['email'] ?? '') }}">
                    </label>
                    <label class="grid gap-2 text-sm font-bold">Phone
                        <input class="vivencia-input" name="phone" required value="{{ old('phone', $customer['phone'] ?? '') }}">
                    </label>
                    <label class="grid gap-2 text-sm font-bold">Password
                        <input class="vivencia-input" name="password" type="password" required minlength="6" placeholder="Create or confirm your dashboard password">
                    </label>
                </div>

                <label class="grid gap-2 text-sm font-bold">Preferred pickup
                    <select class="vivencia-input" name="pickup_date">
                        @if (!empty($pickupDate))
                            <option selected>{{ $pickupDate }}</option>
                        @endif
                        <option>Next available Saturday 2:00 PM - 5:00 PM</option>
                        <option>Next available Sunday 2:00 PM - 5:00 PM</option>
                        <option>Custom pickup request in notes</option>
                    </select>
                </label>

                <label class="grid gap-2 text-sm font-bold">Notes
                    <textarea class="vivencia-input min-h-28" name="notes" placeholder="Allergies, message on cake, pickup needs, or special requests">{{ old('notes') }}</textarea>
                </label>

                <button class="vivencia-button w-full md:w-fit" type="submit">
                    Continue to Payment
                    <span class="material-symbols-outlined text-lg">east</span>
                </button>
            </form>
        </section>

        <aside class="vivencia-card h-fit p-6">
            <div class="flex items-center justify-between">
                <h2 class="font-[Epilogue] text-2xl font-bold">Order Tray</h2>
                <a class="text-sm font-bold text-primary underline" href="/menu">Edit menu</a>
            </div>
            <div class="mt-5 grid gap-3" id="order-items"></div>
            <div class="mt-5 border-t border-primary-container/20 pt-5">
                <div class="flex justify-between text-sm text-on-surface-variant"><span>Subtotal</span><strong id="subtotal">$0.00</strong></div>
                <div class="mt-2 flex justify-between text-sm text-on-surface-variant"><span>50% deposit today</span><strong class="text-primary" id="deposit">$0.00</strong></div>
                <div class="mt-2 flex justify-between text-sm text-on-surface-variant"><span>Due at pickup</span><strong id="pickup-due">$0.00</strong></div>
            </div>
        </aside>
    </main>

    <script src="/js/vivencia-cart.js"></script>
    <script>
        const initialCart = @json($cartJson);
        const params = new URLSearchParams(window.location.search);
        const queryCart = params.get('cart');
        let items = [];

        try {
            items = JSON.parse(queryCart || initialCart || '[]');
        } catch (error) {
            items = [];
        }

        if (!Array.isArray(items) || items.length === 0) {
            items = vivenciaCartStore.asItems(vivenciaCartStore.read());
        }

        const orderItems = document.getElementById('order-items');
        const itemsInput = document.getElementById('items-input');
        const subtotalEl = document.getElementById('subtotal');
        const depositEl = document.getElementById('deposit');
        const pickupDueEl = document.getElementById('pickup-due');

        function renderOrder() {
            let subtotal = 0;
            orderItems.innerHTML = '';

            if (items.length === 0) {
                orderItems.innerHTML = '<div class="rounded-lg bg-surface-container-low p-4 text-sm text-on-surface-variant">Your tray is empty. Add items from the menu first.</div>';
            }

            items.forEach((item) => {
                const line = Number(item.price) * Number(item.quantity);
                subtotal += line;
                const row = document.createElement('div');
                row.className = 'rounded-lg bg-surface-container-low p-4';
                row.innerHTML = `<div class="flex justify-between gap-3"><div><strong>${item.name}</strong><div class="text-sm text-on-surface-variant">${item.quantity} x $${Number(item.price).toFixed(2)}</div></div><strong class="text-primary">$${line.toFixed(2)}</strong></div>`;
                orderItems.appendChild(row);
            });

            itemsInput.value = JSON.stringify(items);
            subtotalEl.innerText = '$' + subtotal.toFixed(2);
            depositEl.innerText = '$' + (subtotal * 0.5).toFixed(2);
            pickupDueEl.innerText = '$' + (subtotal * 0.5).toFixed(2);
        }

        renderOrder();
    </script>
</body>
</html>
