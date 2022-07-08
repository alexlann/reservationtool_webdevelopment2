<header class="bg-rose-400 text-rose-50 pt-5 h-16 mb-6">
    <nav class="container w-8/12 mx-auto">
        <ul class="flex space-x-6 justify-end" data-dropdown-menu="tckp8q-dropdown-menu" role="menubar">
            <li role="menuitem"><a class="hover:text-zinc-900 transition ease-in-out delay-150 {{ (request()->is('home*')) ? 'border-b text-white hover:border-zinc-900' : '' }}" href={{ route('home') }}>{{ __('Home') }}</a></li>
            @auth
                <li role="menuitem"><a class="hover:text-zinc-900 transition ease-in-out delay-150{{ (request()->is('clients*')) ? 'border-b text-white hover:border-zinc-900' : '' }}" href={{ route('clients.index') }}>{{ __('Clients') }}</a></li>
                <li role="menuitem"><a class="hover:text-zinc-900 transition ease-in-out delay-150 {{ (request()->is('reservations*')) ? 'border-b text-white hover:border-zinc-900' : '' }}" href={{ route('reservations.index') }}>{{ __('Reservations') }}</a></li>
            @endauth
            <li role="menuitem"><a class="hover:text-zinc-900 {{ (request()->is('contact*')) ? 'border-b  ext-white hover:border-zinc-900' : '' }}" href={{ route('contact') }}>{{ __('Contact') }}</a></li>
            @auth
            <!-- Authentication -->
            <li role="menuitem">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a class="hover:text-zinc-900 transition ease-in-out delay-150" href={{ route('logout') }}
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </li>
            @endauth
        </ul>
    </nav>
</header>
