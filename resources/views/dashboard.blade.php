<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1>Notifications</h1>
                <div class="notifications">
                    @foreach ($notifications as $notification)
                        <div class="notification">
                            {{ $notification->message }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    @if (session()->has('success'))
        <div class="flash-message">
            {{ session()->get('success') }}
        </div>
    @endif
    
</x-app-layout>
