<x-app-layout>
    <div class="max-w-6xl mx-auto py-12 lg:py-16 my-8">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8 pb-6 border-b border-gray-200">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight">Kelola Akses Pengguna</h2>
                    <p class="text-gray-500 font-medium mt-1 text-sm">Memonitor seluruh akun user yang terdaftar di aplikasi penitipan barang.</p>
                </div>
            </div>
            
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary whitespace-nowrap">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Admin
            </a>
        </div>

        <div class="glass-card p-0 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[600px] text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="py-4 px-6 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                            <th class="py-4 px-6 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse($users as $u)
                            <tr class="hover:bg-white/40 transition-colors">
                                <td class="py-4 px-6 font-bold text-gray-900">
                                    <a href="{{ route('admin.users.show', $u) }}" class="hover:text-orange-500 transition-colors">{{ $u->name }}</a>
                                </td>
                                <td class="py-4 px-6 text-gray-600 font-medium">{{ $u->email }}</td>
                                <td class="py-4 px-6">
                                    @if($u->role === 'admin')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-100 text-purple-700">
                                            Admin
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700">
                                            User
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-center text-gray-600 font-medium">
                                    {{ $u->created_at->format('d M Y') }}
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex justify-end items-center gap-2">
                                        <a href="{{ route('admin.users.show', $u) }}" class="p-2 text-gray-400 hover:text-blue-500 bg-white rounded-lg shadow-sm border border-gray-100 transition-colors" title="Detail User">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $u) }}" class="p-2 text-gray-400 hover:text-orange-500 bg-white rounded-lg shadow-sm border border-gray-100 transition-colors" title="Edit User">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        @if(Auth::id() !== $u->id)
                                        <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Semua data terkait (termasuk barang penitipan) akan ikut terhapus!');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-500 bg-white rounded-lg shadow-sm border border-gray-100 transition-colors" title="Hapus User">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    <p class="font-bold text-gray-400">Tidak ada user terdaftar</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
