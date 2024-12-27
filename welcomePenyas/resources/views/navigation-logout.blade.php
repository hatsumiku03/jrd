<nav x-data="{ open: false }" class="bg-[#7e421d] border-b border-[#7c4b2a]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="/" :active="request()->routeIs('/')">
                        <span class="text-xl">{{ __('Peñas en la vall') }}</span>
                    </x-nav-link>
                </div>
            </div>

            <div class="ms-3 relative -mx-3 flex flex-1 justify-end space-x-3 sm:-my-px sm:ms-10 sm:flex mr-1">
                <x-nav-link wire:navigate href="{{ route('login') }}" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-nav-link>

                <x-nav-link wire:navigate href="{{ route('register') }}" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-nav-link>
            </div>

        </div>
    </div>
</nav>
