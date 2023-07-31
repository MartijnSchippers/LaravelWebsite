<x-app-layout>
    <x-slot name="header">
        {{ __('My Courses') }}
    </x-slot>

    <div class="container">
        <div class="course-items">
            @foreach ($courses as $course)
                <div class="course-item">
                    <!-- <img src="" alt=""> -->
                    <h1>{{ $course->title }}</h1>
                    <p>{{ $course->excerpt }}</p>
                    <a class="button" href="courses/{{ $course->slug }}"> View here </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>