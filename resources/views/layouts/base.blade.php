<x-layouts.app>
    <x-header />

    <main>
        {{ $slot }}
    </main>

    <x-sidebar />

    <x-footer />
</x-layouts.app>