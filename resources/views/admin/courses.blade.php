<x-admin-layout>
    <x-slot name="header">
        {{ __('TODO: admin can set courses') }}
    </x-slot>

    <div class="container">
        @foreach ($courses as $course)
            <x-box-course-admin :course="$course">

            </x-box-course-admin>
        @endforeach
    </div>
</x-admin-layout>