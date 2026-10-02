<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-2xl font-extrabold tracking-tight text-white flex items-center justify-between">
            <span>REGISTER</span>
            <span class="text-[11px] font-mono tracking-widest text-[#E50914] border border-[#E50914]/40 px-2 py-0.5 rounded uppercase">NEW TICKET HOLDER</span>
        </h1>
        <p class="text-xs text-white/50 mt-1">Create an account to purchase tickets, track orders & access VIP perks.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-mono uppercase tracking-wider text-white/70 mb-1.5">Full Name</label>
            <input id="name" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   placeholder="e.g. Tunde Balogun"
                   class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/20 focus:outline-none focus:border-[#E50914] focus:ring-1 focus:ring-[#E50914] transition-all">
            <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-xs text-rose-400" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-mono uppercase tracking-wider text-white/70 mb-1.5">Email Address</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username"
                   placeholder="tunde@example.com"
                   class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/20 focus:outline-none focus:border-[#E50914] focus:ring-1 focus:ring-[#E50914] transition-all">
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-xs text-rose-400" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-mono uppercase tracking-wider text-white/70 mb-1.5">Create Password</label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password"
                   placeholder="At least 8 characters"
                   class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/20 focus:outline-none focus:border-[#E50914] focus:ring-1 focus:ring-[#E50914] transition-all">
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-xs text-rose-400" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-mono uppercase tracking-wider text-white/70 mb-1.5">Confirm Password</label>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="Re-enter password"
                   class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-white/20 focus:outline-none focus:border-[#E50914] focus:ring-1 focus:ring-[#E50914] transition-all">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-xs text-rose-400" />
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                class="w-full py-3.5 px-4 bg-gradient-to-r from-[#B8000C] via-[#E50914] to-[#B8000C] hover:from-[#E50914] hover:to-[#E50914] text-white font-bold text-xs font-mono tracking-widest uppercase rounded-xl transition-all duration-300 shadow-[0_4px_20px_rgba(229,9,20,0.4)] hover:shadow-[0_4px_25px_rgba(229,9,20,0.6)] transform hover:-translate-y-0.5 mt-2">
            CREATE ELITE ACCOUNT
        </button>
    </form>

    <!-- Sign In Link -->
    <div class="mt-6 pt-5 border-t border-white/10 text-center">
        <p class="text-xs text-white/50">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-[#D4AF37] hover:text-[#FFDF73] font-semibold transition-colors ms-1">
                Sign In &rarr;
            </a>
        </p>
    </div>
</x-guest-layout>
