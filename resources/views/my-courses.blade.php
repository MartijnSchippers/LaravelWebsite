<x-app-layout>
    <x-slot name="header">
        {{ __('My Courses') }}
    </x-slot>

    <div class="container">
        <div class="course-items">
            @foreach ($publications as $publication)
                <div class="course-item">
                    <!-- <img src="" alt=""> -->
                    <h1>{{ $publication->course->title }}</h1>
                    <p>{{ $publication->course->excerpt }}</p>
                    <a class="button" href="courses/{{ $publication->course->slug }}"> View here </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>