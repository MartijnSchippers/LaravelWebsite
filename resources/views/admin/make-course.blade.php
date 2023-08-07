<x-admin-layout>
    <x-slot name="header">
        {{ __('Make a course') }}
    </x-slot>

    <div class="container">
        <form action="{{ route('post-course') }}" method="post">
            @csrf
            <lable>title</label>
            <input type="text" name="title" placeholder="title of the post" value="{{ old('title') }}"></input>
            @error('title')
                <span>{{ $message }}</span>
            @enderror

            <lable>excerpt</label>
            <input type="text" name="excerpt" placeholder="excerpt of post" value="{{ old('excerpt') }}"></input>
            @error('excerpt')
                <span>{{ $message }}</span>
            @enderror

            <lable>body</label>
            <input type="text" name="body" placeholder="body of post" value="{{ old('body') }}"></input>
            @error('body')
                <span>{{ $message }}</span>
            @enderror

            <lable>slug</lable>
            <input type="text" name="slug" placeholder="slug of post" value="{{ old('slug') }}"></input>
            @error('slug')
                <span>{{ $message }}</span>
            @enderror

            <input type="hidden" name="admin_id" value="{{ auth()->user()->admin->id }}"></input>

            <button class="button" type="submit">Save</button>
        </form>
    </div>
</x-admin-layout>