<x-mail::message>
    # Hello, {{ $user->name }}!

    <x-mail::button :url="config('app.url')">
        Button Text
    </x-mail::button>

    {{ config('app.name') }}
</x-mail::message>
