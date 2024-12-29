<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-[#262626] border border-gray-300 rounded-md font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm hover:bg-red-800/60 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
