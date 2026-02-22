<?php

$user = \App\Models\User::factory()->make(['role' => 'super_admin']);
\Illuminate\Support\Facades\Auth::login($user);

echo "TESTING APP LAYOUT WRAPPER...\n";
try {
    $html = view('layouts.app', [
        'slot' => '<div>CONTENT</div>'
    ])->render();

    if (str_contains($html, 'superadmin-layout')) {
        echo "SUCCESS: It yielded superadmin-layout natively!\n";
    } elseif (str_contains($html, 'Super Admin Dashboard')) {
        echo "SUCCESS: The view rendered Super Admin Dashboard elements!\n";
    } else {
        echo "FAILED to yield Super Admin UI. HTML output snippet:\n";
        echo substr($html, 0, 500) . "...\n";
    }
} catch (\Exception $e) {
    echo "ERROR Rendering App Layout: " . $e->getMessage() . "\n";
}
