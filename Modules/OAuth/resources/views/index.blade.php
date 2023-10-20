<x-app-layout :data="$head ?? []">
    <h1>Hello World</h1>

    <p>
        Module: {!! config('oauth.name') !!}
    </p>
</x-app-layout>
