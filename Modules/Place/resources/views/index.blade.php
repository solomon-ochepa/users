<x-app-layout :data="$head ?? []">
    <h1>Hello World</h1>

    <p>
        Module: {!! config('place.name') !!}
    </p>
</x-app-layout>
