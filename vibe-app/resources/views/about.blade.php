<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About | Vivencia</title>
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
            <nav class="hidden flex-wrap items-center gap-5 text-sm font-bold uppercase tracking-wide lg:flex">
                <a class="text-on-surface-variant hover:text-primary" href="/">Home</a>
                <a class="text-on-surface-variant hover:text-primary" href="/menu">Menu</a>
                <a class="text-on-surface-variant hover:text-primary" href="/order">Pre-Order</a>
                <a class="text-on-surface-variant hover:text-primary" href="/gallery">Gallery</a>
                <a class="text-primary" href="/about">About</a>
                <a class="text-on-surface-variant hover:text-primary" href="/contact">Contact</a>
            </nav>
            <a class="inline-flex items-center justify-center rounded-full bg-tertiary-fixed-dim px-5 py-2 text-sm font-bold uppercase tracking-wide text-on-tertiary-fixed shadow hover:bg-tertiary-fixed" href="/menu">Order Now</a>
        </div>
    </header>

    <main>
        <section class="relative min-h-[560px] overflow-hidden bg-inverse-surface">
            <img class="absolute inset-0 h-full w-full object-cover" src="/images/vivencia/header-photo.jpg" alt="Vivencia family at a Filipino bakery pop-up table">
            <div class="absolute inset-0 bg-gradient-to-r from-[#2b1009]/95 via-[#2b1009]/70 to-[#2b1009]/20"></div>
            <div class="relative mx-auto flex min-h-[560px] max-w-[1180px] items-end px-4 py-14 md:px-8">
                <div class="max-w-3xl text-white">
                    <p class="font-bold uppercase tracking-[0.22em] text-tertiary-fixed-dim">Our story</p>
                    <h1 class="mt-3 font-[Epilogue] text-5xl font-extrabold md:text-6xl">Named for our grandmother. Baked from memory.</h1>
                    <p class="mt-5 text-lg leading-8 text-white/85">Vivencia carries the name of our grandmother and the spirit of the family bakery we once had in the Philippines.</p>
                </div>
            </div>
        </section>

        <section class="mx-auto grid max-w-[1180px] gap-8 px-4 py-12 md:px-8 lg:grid-cols-[1fr_420px]">
            <article class="vivencia-card p-6 md:p-8">
                <p class="font-bold uppercase tracking-[0.18em] text-primary">From the Philippines to San Antonio</p>
                <h2 class="mt-2 font-[Epilogue] text-4xl font-extrabold">A bakery name with family behind it</h2>
                <div class="mt-6 grid gap-5 text-lg leading-8 text-on-surface-variant">
                    <p>Vivencia is named after our grandmother, whose kitchen taught us that food is more than a recipe. It is how family gathers, how stories are repeated, and how a home can be remembered through the smell of warm bread.</p>
                    <p>Before Vivencia in San Antonio, our family had a bakery in the Philippines. The days started early, the counters filled quickly, and the best sellers were the kinds of bakes people brought to birthdays, merienda, church gatherings, and weekend visits with relatives.</p>
                    <p>When we moved forward with Vivencia here in Texas, we wanted every cake, custard, bread, and delicacy to feel connected to that beginning. The flavors are Filipino, the process is small-batch, and the heart of it is still our grandmother's name.</p>
                    <p>Today, Vivencia focuses on pickup orders and pop-up style bakery drops: ube cakes, custard cakes, Spanish bread, pandesal, flan, muffins, and the comfort bakes customers keep coming back for.</p>
                </div>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a class="vivencia-button" href="/menu">
                        <span class="material-symbols-outlined text-lg">restaurant_menu</span>
                        View Menu
                    </a>
                    <a class="vivencia-button secondary" href="/contact">
                        <span class="material-symbols-outlined text-lg">chat</span>
                        Contact Us
                    </a>
                </div>
            </article>

            <aside class="grid gap-6">
                <div class="vivencia-card overflow-hidden">
                    <img class="h-80 w-full object-cover" src="/images/vivencia/vivencia-pop-up.jpg" alt="Vivencia pop-up table with Filipino baked goods">
                    <div class="p-5">
                        <h3 class="font-[Epilogue] text-2xl font-bold">Pop-up roots</h3>
                        <p class="mt-2 text-on-surface-variant">A family table, a bakery display, and the same recipes customers remember after one bite.</p>
                    </div>
                </div>
                <div class="vivencia-card overflow-hidden">
                    <img class="h-72 w-full object-cover" src="/images/vivencia/product-photos.jpg" alt="Vivencia custard cakes packaged for pickup">
                    <div class="p-5">
                        <h3 class="font-[Epilogue] text-2xl font-bold">Made for sharing</h3>
                        <p class="mt-2 text-on-surface-variant">Every bake is packed for pickup and meant for the people waiting at the table.</p>
                    </div>
                </div>
            </aside>
        </section>
    </main>
</body>
</html>
