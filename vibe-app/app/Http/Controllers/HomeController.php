<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class HomeController extends Controller
{
    private const ADMIN_EMAIL = 'admin@vivencia.local';
    private const ADMIN_PASSWORD = 'VivenciaAdmin2026!';

    public function index(): View
    {
        return view('home');
    }

    public function menu(): View
    {
        return view('menu');
    }

    public function order(Request $request): View
    {
        return view('order', [
            'cartJson' => $request->query('cart', '{}'),
            'customer' => $this->currentCustomer($request),
        ]);
    }

    public function payment(Request $request): View|RedirectResponse
    {
        $validated = $request->validate([
            'items' => ['required', 'string'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:40'],
            'password' => ['required', 'string', 'min:6', 'max:120'],
            'pickup_date' => ['nullable', 'string', 'max:80'],
            'notes' => ['nullable', 'string', 'max:600'],
        ]);

        $items = $this->normalizeItems($validated['items']);
        if ($items === []) {
            return redirect()->route('order')->with('error', 'Please add at least one item to your order.');
        }

        $subtotal = $this->subtotal($items);

        return view('payment', [
            'checkout' => [
                ...$validated,
                'items' => $items,
                'subtotal' => $subtotal,
                'deposit' => round($subtotal * 0.5, 2),
            ],
        ]);
    }

    public function completePayment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'items' => ['required', 'string'],
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:40'],
            'password' => ['required', 'string', 'min:6', 'max:120'],
            'pickup_date' => ['nullable', 'string', 'max:80'],
            'notes' => ['nullable', 'string', 'max:600'],
            'payment_method' => ['required', 'string', 'max:40'],
        ]);

        $items = $this->normalizeItems($validated['items']);
        if ($items === []) {
            return redirect()->route('order')->with('error', 'Please add at least one item to your order.');
        }

        $customers = $this->readStore('customers');
        $emailKey = strtolower($validated['email']);
        $customer = $customers[$emailKey] ?? [
            'id' => 'CUST-'.strtoupper(substr(hash('sha256', $emailKey), 0, 8)),
            'created_at' => now()->toDateTimeString(),
        ];

        $customer = [
            ...$customer,
            'name' => $validated['name'],
            'email' => $emailKey,
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'updated_at' => now()->toDateTimeString(),
        ];
        $customers[$emailKey] = $customer;
        $this->writeStore('customers', $customers);

        $subtotal = $this->subtotal($items);
        $order = [
            'id' => 'VIV-'.now()->format('ymd-His'),
            'customer_email' => $emailKey,
            'items' => $items,
            'subtotal' => $subtotal,
            'deposit' => round($subtotal * 0.5, 2),
            'pickup_due' => round($subtotal * 0.5, 2),
            'pickup_date' => $validated['pickup_date'] ?: 'Next available Saturday 2:00 PM - 5:00 PM',
            'notes' => $validated['notes'] ?? '',
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'Deposit authorized',
            'status' => 'Collection slot pending confirmation',
            'created_at' => now()->toDateTimeString(),
        ];

        $orders = $this->readStore('orders');
        $orders[$order['id']] = $order;
        $this->writeStore('orders', $orders);

        $request->session()->put('customer_email', $emailKey);
        $request->session()->put('last_order_id', $order['id']);

        return redirect()->route('collection')->with('success', 'Payment received. Your order is saved to your dashboard.');
    }

    public function customerLogin(Request $request): View|RedirectResponse
    {
        if ($this->currentCustomer($request)) {
            return redirect()->route('customer.dashboard');
        }

        return view('customer-login');
    }

    public function customerAuthenticate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $customers = $this->readStore('customers');
        $customer = $customers[strtolower($validated['email'])] ?? null;

        if (!$customer || !Hash::check($validated['password'], $customer['password'] ?? '')) {
            return back()->with('error', 'Those customer login details do not match our records.');
        }

        $request->session()->put('customer_email', $customer['email']);

        return redirect()->route('customer.dashboard');
    }

    public function customerDashboard(Request $request): View|RedirectResponse
    {
        $customer = $this->currentCustomer($request);
        if (!$customer) {
            return redirect()->route('customer.login');
        }

        return view('customer-dashboard', [
            'customer' => $customer,
            'orders' => $this->ordersFor($customer['email']),
        ]);
    }

    public function customerProfileUpdate(Request $request): RedirectResponse
    {
        $customer = $this->currentCustomer($request);
        if (!$customer) {
            return redirect()->route('customer.login');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:40'],
            'password' => ['nullable', 'string', 'min:6', 'max:120'],
        ]);

        $customers = $this->readStore('customers');
        $email = $customer['email'];
        $customers[$email]['name'] = $validated['name'];
        $customers[$email]['phone'] = $validated['phone'];
        $customers[$email]['updated_at'] = now()->toDateTimeString();

        if (!empty($validated['password'])) {
            $customers[$email]['password'] = Hash::make($validated['password']);
        }

        $this->writeStore('customers', $customers);

        return redirect()->route('customer.dashboard')->with('success', 'Account details updated.');
    }

    public function customerLogout(Request $request): RedirectResponse
    {
        $request->session()->forget(['customer_email', 'last_order_id']);

        return redirect()->route('home');
    }

    public function collection(Request $request): View|RedirectResponse
    {
        $customer = $this->currentCustomer($request);
        if (!$customer) {
            return redirect()->route('customer.login');
        }

        return view('collection', [
            'customer' => $customer,
            'orders' => $this->ordersFor($customer['email']),
            'lastOrderId' => $request->session()->get('last_order_id'),
        ]);
    }

    public function adminLogin(Request $request): View|RedirectResponse
    {
        if ($request->session()->get('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin-login');
    }

    public function adminAuthenticate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (
            strtolower($validated['email']) !== self::ADMIN_EMAIL ||
            $validated['password'] !== self::ADMIN_PASSWORD
        ) {
            return back()->with('error', 'Admin access denied.');
        }

        $request->session()->put('admin_authenticated', true);

        return redirect()->route('admin.dashboard');
    }

    public function adminDashboard(Request $request): View|RedirectResponse
    {
        if (!$request->session()->get('admin_authenticated')) {
            return redirect()->route('admin.login');
        }

        return view('admin-dashboard', [
            'orders' => array_values($this->readStore('orders')),
            'customers' => array_values($this->readStore('customers')),
        ]);
    }

    public function adminLogout(Request $request): RedirectResponse
    {
        $request->session()->forget('admin_authenticated');

        return redirect()->route('admin.login');
    }

    public function construction(string $page): View
    {
        return view('construction', [
            'page' => ucwords(str_replace('-', ' ', $page)),
        ]);
    }

    public function generate(Request $request): string
    {
        $request->validate([
            'business_type' => ['required', 'string', 'max:255'],
        ]);

        return 'Generated successfully';
    }

    private function normalizeItems(string $itemsJson): array
    {
        $decoded = json_decode($itemsJson, true);
        if (!is_array($decoded)) {
            return [];
        }

        return collect($decoded)
            ->map(fn ($item) => [
                'name' => (string) ($item['name'] ?? ''),
                'price' => (float) ($item['price'] ?? 0),
                'quantity' => (int) ($item['quantity'] ?? 0),
            ])
            ->filter(fn ($item) => $item['name'] !== '' && $item['price'] >= 0 && $item['quantity'] > 0)
            ->values()
            ->all();
    }

    private function subtotal(array $items): float
    {
        return round(array_reduce(
            $items,
            fn (float $total, array $item) => $total + ($item['price'] * $item['quantity']),
            0.0,
        ), 2);
    }

    private function currentCustomer(Request $request): ?array
    {
        $email = $request->session()->get('customer_email');
        if (!$email) {
            return null;
        }

        $customers = $this->readStore('customers');

        return $customers[$email] ?? null;
    }

    private function ordersFor(string $email): array
    {
        return array_values(array_filter(
            $this->readStore('orders'),
            fn (array $order) => ($order['customer_email'] ?? '') === $email,
        ));
    }

    private function readStore(string $name): array
    {
        $path = storage_path("app/vivencia/{$name}.json");
        if (!File::exists($path)) {
            return [];
        }

        $decoded = json_decode((string) File::get($path), true);

        return is_array($decoded) ? $decoded : [];
    }

    private function writeStore(string $name, array $data): void
    {
        $directory = storage_path('app/vivencia');
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        File::put(
            "{$directory}/{$name}.json",
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),
        );
    }
}
