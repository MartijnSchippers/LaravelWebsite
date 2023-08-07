<x-app-layout>
    <x-slot name="header">
        {{ __('Courses') }}
    </x-slot>

    <div class="container">
        <h1>Thank you for your purchase! The courses will soon be added to your account!</h1>
        
        <a href="{{ route('dashboard') }}" class="button">return to homescreen</a>
    </div>
    @if (session()->has('success'))
        <div class="flash-message">
            {{ session()->get('success') }}
        </div>
    @endif
</x-app-layout>