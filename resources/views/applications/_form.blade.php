@if ($errors->any())
    <div class="mb-6 p-4 border border-elite-crimson bg-elite-crimson/10 text-elite-crimson font-mono text-sm">
        @foreach ($errors->all() as $error)
            <div>✗ {{ $error }}</div>
        @endforeach
    </div>
@endif

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-5">
    @csrf
    <input type="hidden" name="type" value="{{ $type }}">

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">CONTACT NAME *</label>
            <input type="text" name="contact_name" value="{{ old('contact_name', auth()->user()->name ?? '') }}" required
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
        </div>
        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">
                {{ $businessLabel ?? 'BUSINESS / BRAND NAME' }}
            </label>
            <input type="text" name="business_name" value="{{ old('business_name') }}"
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">EMAIL *</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
        </div>
        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">PHONE / WHATSAPP *</label>
            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" required
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
        </div>
    </div>

    <div>
        <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">{{ $descriptionLabel ?? 'TELL US ABOUT YOU' }} *</label>
        <textarea name="description" rows="5" required
                  placeholder="{{ $descriptionPlaceholder ?? '' }}"
                  class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm resize-none">{{ old('description') }}</textarea>
    </div>

    <div class="grid md:grid-cols-3 gap-5">
        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">WEBSITE</label>
            <input type="url" name="website" value="{{ old('website') }}" placeholder="https://"
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
        </div>
        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">INSTAGRAM</label>
            <input type="text" name="instagram" value="{{ old('instagram') }}" placeholder="@handle"
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
        </div>
        <div>
            <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">TIKTOK</label>
            <input type="text" name="tiktok" value="{{ old('tiktok') }}" placeholder="@handle"
                   class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold focus:ring-elite-gold text-elite-bone px-4 py-3 font-mono text-sm">
        </div>
    </div>

    <div>
        <label class="font-mono text-[10px] tracking-ultra text-elite-gold block mb-2">
            DOCUMENTS (PDF/PNG/JPG — max 5 files, 5MB each)
        </label>
        <input type="file" name="documents[]" multiple accept=".pdf,.jpg,.jpeg,.png"
               class="w-full bg-elite-black border border-elite-steel focus:border-elite-gold text-elite-bone px-4 py-3 font-mono text-sm file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-elite-gold file:text-elite-black file:font-bebas file:tracking-wider">
        <div class="font-mono text-[10px] text-elite-smoke mt-2">
            {{ $documentHint ?? 'Business registration, portfolio, or any relevant document.' }}
        </div>
    </div>

    <button type="submit" class="btn-gold w-full justify-center !py-5">
        SUBMIT APPLICATION →
    </button>

    <p class="text-center font-mono text-[10px] text-elite-smoke mt-4">
        By submitting, you agree to our <a href="#" class="text-elite-gold underline">Terms</a> and <a href="#" class="text-elite-gold underline">Privacy Policy</a>.
    </p>
</form>