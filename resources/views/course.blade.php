<x-app-layout>
    <x-slot name="header">
        {{ __('Courses') }}
    </x-slot>

    <div class="container">
        <h1>{{ $course->title }}</h1>
        {!! $course->body !!}
        
    </div>
</x-app-layout>