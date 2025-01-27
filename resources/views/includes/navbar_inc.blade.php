<div class="flex items-center justify-between w-100">
    <div class="company-name text-white">Christos</div>
    <div class="category flex gap-5">
        <button class="btn btn-primary shirt"><a href="/product/shirt">shirt</a></button>
        <button class="btn btn-primary shoe"><a href="/product/shoe">shoe</a></button>
        <button class="btn btn-primary shop"><a href="/product">shop</a></button>
    </div>
    <div class="flex">
    <div class="cart-logo bg-white" id="cart-logo">
        <div class="indicator">
            <span class="indicator-item indicator-center badge badge-secondary" id="cart-indicator">1</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>
    </div>
    @if (!Auth::user())
    <button class="btn btn-primary" type='submit'><a href="{{route('login')}}">login</a></button>
    <button class="btn btn-primary" type='submit'><a href="{{route('register')}}">signup</a></button>
    @endif

    @if (Auth::user())
    <button class="btn btn-primary" type='submit'><a href="#">profile</a></button>
    @endif
    </div>
</div>