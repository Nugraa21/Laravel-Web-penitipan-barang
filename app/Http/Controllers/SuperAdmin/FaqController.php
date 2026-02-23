<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $faq = Faq::create($validated);

        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'Create FAQ',
            'description' => "Sistem: Menambahkan FAQ baru: '" . Str::limit($faq->question, 50) . "'.",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', __('FAQ berhasil ditambahkan.'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $oldQuestion = Str::limit($faq->question, 50);
        $faq->update($validated);

        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'Update FAQ',
            'description' => "Sistem: Mengubah FAQ: '{$oldQuestion}'.",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', __('FAQ berhasil diperbarui.'));
    }

    public function destroy(Request $request, Faq $faq)
    {
        $question = Str::limit($faq->question, 50);
        $faq->delete();

        UserLog::create([
            'user_id' => Auth::id(),
            'action' => 'Delete FAQ',
            'description' => "Sistem: Menghapus FAQ: '{$question}'.",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->back()->with('success', __('FAQ berhasil dihapus.'));
    }
}
