<x-app-layout>
    <x-slot name="header">
        {{ __('Courses') }}
    </x-slot>

    <div class="container">
        <div class="course-items">
            @foreach ($publifications as $publification)
                @include('components.box-course-buy', ['publification' => $publification])
            @endforeach
        </div>
    </div>
</x-app-layout>