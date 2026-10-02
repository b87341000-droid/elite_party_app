<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold tracking-tight text-white flex items-center justify-between">
            <span>RESET PASS</span>
            <span class="text-[11px] font-mono tracking-widest text-[#D4AF37] border border-[#D4AF37]/30 px-2 py-0.5 rounded uppercase">RECOVERY</span>
        </h1>
        <p class="text-xs text-white/50 mt-1">Forgot your password? Enter your email and we'll send you a reset link.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-mono uppercase tracking-wider text-white/70 mb-1.5">Email Address</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   placeholder="name@example.com"
                   class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/20 focus:outline-none focus:border-[#E50914] focus:ring-1 focus:ring-[#E50914] transition-all">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-rose-400" />
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full py-3.5 px-4 bg-gradient-to-r from-[#B8000C] via-[#E50914] to-[#B8000C] hover:from-[#E50914] hover:to-[#E50914] text-white font-bold text-xs font-mono tracking-widest uppercase rounded-xl transition-all duration-300 shadow-[0_4px_20px_rgba(229,9,20,0.4)] hover:shadow-[0_4px_25px_rgba(229,9,20,0.6)] transform hover:-translate-y-0.5 mt-2">
            EMAIL PASSWORD RESET LINK
        </button>
    </form>

    <!-- Back to Login -->
    <div class="mt-6 pt-5 border-t border-white/10 text-center">
        <a href="{{ route('login') }}" class="text-xs text-white/50 hover:text-[#D4AF37] transition-colors">
            &larr; Back to Sign In
        </a>
    </div>
</x-guest-layout>
