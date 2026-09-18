<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact | Vivencia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@600;700;800&family=Nunito+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/vivencia-brown.css">
</head>
<body class="vivencia-shell">
    <header class="bg-surface-container-lowest/95 border-b border-primary-container/20">
        <div class="mx-auto flex min-h-20 max-w-[1280px] flex-wrap items-center justify-between gap-4 px-4 py-4 md:px-8 lg:px-12">
            <a href="/" class="flex items-center gap-3">
                <img class="h-12 w-12 rounded-full bg-white object-contain" src="/images/menu/vivencia-logo.jpeg" alt="Vivencia Heritage Bakery Logo">
                <div>
                    <div class="font-[Epilogue] text-2xl font-bold text-primary">Vivencia</div>
                    <div class="text-xs font-bold uppercase tracking-[0.18em] text-on-surface-variant">Bread · Cake · Delicacy</div>
                </div>
            </a>
            <nav class="flex flex-wrap items-center gap-5 text-sm font-bold uppercase tracking-wide">
                <a class="text-on-surface-variant hover:text-primary" href="/">Home</a>
                <a class="text-on-surface-variant hover:text-primary" href="/menu">Menu</a>
                <a class="text-on-surface-variant hover:text-primary" href="/order">Order</a>
                <a class="text-primary" href="/contact">Contact</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="relative min-h-[520px] overflow-hidden bg-inverse-surface">
            <img class="absolute inset-0 h-full w-full object-cover" src="/images/vivencia/header-photo.jpg" alt="Vivencia pop-up table with family and Filipino baked goods">
            <div class="absolute inset-0 bg-gradient-to-r from-[#2b1009]/90 via-[#2b1009]/60 to-transparent"></div>
            <div class="relative mx-auto flex min-h-[520px] max-w-[1180px] items-end px-4 py-12 md:px-8">
                <div class="max-w-2xl text-white">
                    <p class="font-bold uppercase tracking-[0.22em] text-tertiary-fixed-dim">San Antonio pickup bakery</p>
                    <h1 class="mt-3 font-[Epilogue] text-5xl font-extrabold">Contact Vivencia</h1>
                    <p class="mt-4 text-lg text-white/85">Message us for custom cakes, pop-up pickup details, and Filipino bread and delicacy pre-orders.</p>
                </div>
            </div>
        </section>

        <section class="mx-auto grid max-w-[1180px] gap-6 px-4 py-12 md:grid-cols-[1fr_420px] md:px-8">
            <div class="vivencia-card p-6 md:p-8">
                <p class="font-bold uppercase tracking-[0.18em] text-primary">Start here</p>
                <h2 class="mt-2 font-[Epilogue] text-3xl font-extrabold">Send a message or place an order</h2>
                <p class="mt-3 text-on-surface-variant">Vivencia is a small-batch, pickup-only bakery. The fastest way to ask about availability is through social media or the order page.</p>

                <div class="mt-8 grid gap-4">
                    <a class="vivencia-button w-full justify-center md:w-fit" href="/order">
                        <span class="material-symbols-outlined text-lg">shopping_bag</span>
                        Add to Order
                    </a>
                    <a class="flex items-center justify-between rounded-lg border border-primary-container/25 bg-surface-container-low p-4 font-bold text-primary hover:bg-surface-container" href="https://www.instagram.com/vivencia_satx?igsh=MWxmOTE0Z2M4cmxxZw==" target="_blank" rel="noopener">
                        Instagram @vivencia_satx
                        <span class="material-symbols-outlined">open_in_new</span>
                    </a>
                    <a class="flex items-center justify-between rounded-lg border border-primary-container/25 bg-surface-container-low p-4 font-bold text-primary hover:bg-surface-container" href="https://www.facebook.com/profile.php?id=100076704361961" target="_blank" rel="noopener">
                        Facebook Vivencia
                        <span class="material-symbols-outlined">open_in_new</span>
                    </a>
                </div>
            </div>

            <aside class="grid gap-6">
                <div class="vivencia-card overflow-hidden">
                    <img class="h-72 w-full object-cover" src="/images/vivencia/vivencia-pop-up.jpg" alt="Vivencia pop-up display with baked goods">
                    <div class="p-5">
                        <h3 class="font-[Epilogue] text-2xl font-bold">Pop-up pickups</h3>
                        <p class="mt-2 text-on-surface-variant">Follow Vivencia for the newest pickup windows, pop-up menus, and seasonal bake drops.</p>
                    </div>
                </div>
                <div class="vivencia-card p-5">
                    <h3 class="font-[Epilogue] text-2xl font-bold">Pickup Area</h3>
                    <p class="mt-2 text-on-surface-variant">San Antonio, TX · near Wurzbach & Bandera Rd · pickup only</p>
                </div>
            </aside>
        </section>
    </main>
</body>
</html>
