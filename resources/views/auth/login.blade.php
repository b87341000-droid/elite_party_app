<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold tracking-tight text-white flex items-center justify-between">
            <span>SIGN IN</span>
            <span class="text-[11px] font-mono tracking-widest text-[#D4AF37] border border-[#D4AF37]/30 px-2 py-0.5 rounded uppercase">MEMBER &bull; ADMIN</span>
        </h1>
        <p class="text-xs text-white/50 mt-1">Access your tickets, vendor portal, or administrative controls.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-mono uppercase tracking-wider text-white/70 mb-1.5">Email Address</label>
            <div class="relative">
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="name@eliteblockparty.com"
                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/20 focus:outline-none focus:border-[#E50914] focus:ring-1 focus:ring-[#E50914] transition-all">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-rose-400" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-xs font-mono uppercase tracking-wider text-white/70">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs text-white/40 hover:text-[#D4AF37] transition-colors" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                   class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/20 focus:outline-none focus:border-[#E50914] focus:ring-1 focus:ring-[#E50914] transition-all">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-rose-400" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" 
                       type="checkbox" 
                       name="remember" 
                       class="w-4 h-4 rounded bg-white/5 border-white/20 text-[#E50914] focus:ring-0 focus:ring-offset-0">
                <span class="ms-2 text-xs text-white/60">Remember me</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full py-3.5 px-4 bg-gradient-to-r from-[#B8000C] via-[#E50914] to-[#B8000C] hover:from-[#E50914] hover:to-[#E50914] text-white font-bold text-xs font-mono tracking-widest uppercase rounded-xl transition-all duration-300 shadow-[0_4px_20px_rgba(229,9,20,0.4)] hover:shadow-[0_4px_25px_rgba(229,9,20,0.6)] transform hover:-translate-y-0.5 mt-2">
            SIGN IN TO PORTAL
        </button>
    </form>

    <!-- Register Link -->
    <div class="mt-6 pt-5 border-t border-white/10 text-center">
        <p class="text-xs text-white/50">
            Don't have an account yet? 
            <a href="{{ route('register') }}" class="text-[#D4AF37] hover:text-[#FFDF73] font-semibold transition-colors ms-1">
                Create Account &rarr;
            </a>
        </p>
    </div>

    <!-- Credentials Helper Box -->
    <div class="mt-4 p-3 bg-white/[0.03] border border-white/5 rounded-xl text-[11px] font-mono text-white/40 space-y-1">
        <div class="text-white/60 font-semibold text-[10px] uppercase tracking-wider">Quick Admin Access:</div>
        <div class="flex justify-between">
            <span>Admin: <span class="text-white/80">admin@eliteblockparty.com</span></span>
            <span class="text-[#D4AF37]">EliteAdmin@2025</span>
        </div>
    </div>
</x-guest-layout>
