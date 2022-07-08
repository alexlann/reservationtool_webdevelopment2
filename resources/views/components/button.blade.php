<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-3 py-2 border border-rose-400 rounded-sm uppercase text-rose-400 text-sm hover:text-zinc-900 hover:border-zinc-900']) }}>
    {{ $slot }}
</button>
