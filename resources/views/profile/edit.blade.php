<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 lg:py-16 my-8">

        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-200">
            <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">{{ __('Profil Akun') }}</h2>
                <p class="text-gray-500 font-medium mt-1 text-sm">Kelola informasi publik dan keamanan kata sandi Anda.
                </p>
            </div>
        </div>

        <div class="space-y-8">
            <div class="glass-card p-8 border-t-4 border-t-blue-400">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="glass-card p-8 border-t-4 border-t-purple-400">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="glass-card p-8 bg-red-50/50 border-t-4 border-t-red-500 border-red-100 shadow-sm">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>