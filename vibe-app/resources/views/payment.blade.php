<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment | Vivencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@600;700;800&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/vivencia-brown.css">
    <style>
        .qr-demo {
            width: 190px;
            height: 190px;
            background:
                linear-gradient(90deg, #2b1009 10px, transparent 10px) 0 0 / 38px 38px,
                linear-gradient(#2b1009 10px, transparent 10px) 0 0 / 38px 38px,
                conic-gradient(from 90deg, #2b1009 25%, #fffdf8 0 50%, #2b1009 0 75%, #fffdf8 0) 9px 9px / 42px 42px;
            border: 12px solid #fffdf8;
            box-shadow: inset 0 0 0 2px rgba(43, 16, 9, 0.18);
        }
    </style>
</head>
<body class="vivencia-shell">
    <main class="mx-auto grid min-h-screen max-w-[1050px] place-items-center px-4 py-10">
        <section class="vivencia-card grid w-full gap-8 p-6 md:grid-cols-[1fr_340px] md:p-8">
            <div>
                <p class="font-bold uppercase tracking-[0.18em] text-primary">Deposit payment</p>
                <h1 class="mt-2 font-[Epilogue] text-4xl font-extrabold">Confirm your bake slot</h1>
                <p class="mt-3 text-on-surface-variant">Use Apple Pay or scan the QR placeholder. This demo records the deposit as authorized and completes the customer login flow.</p>

                <div class="mt-6 grid gap-3">
                    @foreach ($checkout['items'] as $item)
                        <div class="rounded-lg bg-surface-container-low p-4">
                            <div class="flex justify-between gap-4">
                                <div>
                                    <strong>{{ $item['name'] }}</strong>
                                    <div class="text-sm text-on-surface-variant">{{ $item['quantity'] }} x ${{ number_format($item['price'], 2) }}</div>
                                </div>
                                <strong class="text-primary">${{ number_format($item['price'] * $item['quantity'], 2) }}</strong>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 rounded-lg bg-surface-container-high p-4">
                    <div class="flex justify-between"><span>Subtotal</span><strong>${{ number_format($checkout['subtotal'], 2) }}</strong></div>
                    <div class="mt-2 flex justify-between text-primary"><span>Deposit due now</span><strong>${{ number_format($checkout['deposit'], 2) }}</strong></div>
                    <div class="mt-2 flex justify-between text-on-surface-variant"><span>Due at pickup</span><strong>${{ number_format($checkout['deposit'], 2) }}</strong></div>
                </div>
            </div>

            <form class="grid gap-5 rounded-lg bg-surface-container-low p-5" method="POST" action="{{ route('payment.complete') }}" id="payment-form">
                @csrf
                <input type="hidden" name="items" value='@json($checkout["items"])'>
                <input type="hidden" name="name" value="{{ $checkout['name'] }}">
                <input type="hidden" name="email" value="{{ $checkout['email'] }}">
                <input type="hidden" name="phone" value="{{ $checkout['phone'] }}">
                <input type="hidden" name="password" value="{{ $checkout['password'] }}">
                <input type="hidden" name="pickup_date" value="{{ $checkout['pickup_date'] ?? '' }}">
                <input type="hidden" name="notes" value="{{ $checkout['notes'] ?? '' }}">
                <input type="hidden" name="payment_method" id="payment-method" value="Apple Pay demo">

                <button class="vivencia-button w-full bg-black" type="submit" onclick="document.getElementById('payment-method').value='Apple Pay demo'">
                    <span class="material-symbols-outlined text-lg">phone_iphone</span>
                    Pay with Apple Pay
                </button>

                <div class="grid place-items-center gap-3 rounded-lg bg-white p-4">
                    <div class="qr-demo" aria-label="Demo QR payment code"></div>
                    <button class="vivencia-button secondary w-full" type="submit" onclick="document.getElementById('payment-method').value='QR demo'">
                        I scanned the QR
                    </button>
                </div>

                <p class="text-center text-xs font-bold uppercase tracking-wide text-on-surface-variant">Demo payment mode</p>
            </form>
        </section>
    </main>
    <script src="/js/vivencia-cart.js"></script>
    <script>
        document.getElementById('payment-form').addEventListener('submit', () => vivenciaCartStore.clear());
    </script>
</body>
</html>
