<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $faqs = \App\Models\Faq::orderBy('order', 'asc')->get();
        // Get the latest 10 logs specifically relating to settings or FAQs for inline display
        $recentLogs = UserLog::with('user')
            ->whereIn('action', ['Update Pengaturan', 'Create Pengaturan', 'Create FAQ', 'Update FAQ', 'Delete FAQ'])
            ->latest()
            ->take(8)
            ->get();

        return view('superadmin.settings', compact('settings', 'faqs', 'recentLogs'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        $changesCount = 0;

        foreach ($data as $key => $value) {
            $setting = Setting::where('key', $key)->first();

            if (!$setting) {
                Setting::create([
                    'key' => $key,
                    'value' => $value
                ]);
                $changesCount++;

                UserLog::create([
                    'user_id' => Auth::id(),
                    'action' => 'Create Pengaturan',
                    'description' => "Sistem: Menambahkan pengaturan baru '{$key}' dengan nilai '" . Str::limit($value ?? '', 50) . "'.",
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            } else if ($setting->value !== $value) {
                $oldValue = Str::limit($setting->value ?? '', 50);
                $newValue = Str::limit($value ?? '', 50);

                $setting->update(['value' => $value]);
                $changesCount++;

                UserLog::create([
                    'user_id' => Auth::id(),
                    'action' => 'Update Pengaturan',
                    'description' => "Sistem: Mengubah pengaturan '{$key}' dari '{$oldValue}' menjadi '{$newValue}'.",
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            }
        }

        if ($changesCount > 0) {
            return redirect()->back()->with('success', __('Pengaturan berhasil diperbarui dan dicatat dalam Log Aktivitas.'));
        }

        return redirect()->back()->with('success', __('Tidak ada perubahan pengaturan.'));
    }
}
