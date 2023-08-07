<x-app-layout>
    <x-slot name="header">
        {{ __('Edit course') }}
    </x-slot>

    <div class="container">
        <form action="./save" method="post" class="build-course">
            @csrf
            <div class="title">
                <lable>title</label>
                <input type="text" name="title" placeholder="title of the post" value="{{ $course->title }}" class="input"></input>
                @error('title')
                    <span>{{ $message }}</span>
                @enderror
            </div>

            <lable>excerpt</label>
            <input type="text" name="excerpt" placeholder="excerpt of post" value="{{ $course->excerpt }}" class="input"></input>
            @error('excerpt')
                <span>{{ $message }}</span>
            @enderror

            <lable>body</label>
            <textarea type="text" name="body" placeholder="body of post">{{ $course->body }}</textarea>
            @error('body')
                <span>{{ $message }}</span>
            @enderror

            <lable>slug</lable>
            <input type="text" name="slug" placeholder="slug of post" value="{{ $course->slug }}" class="input"></input>
            @error('slug')
                <span>{{ $message }}</span>
            @enderror

            <input type="hidden" name="admin_id" value="{{ auth()->user()->admin->id }}"></input>

            <button class="button" type="submit">Save</button>
        </form>
    </div>
</x-app-layout>