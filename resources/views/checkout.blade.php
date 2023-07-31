<x-app-layout>
    <x-slot name="header">
        {{ __('Courses') }}
    </x-slot>

    <div class="container">
        <h1>Checkout</h1>
        <p>
            <br>Receipt:
            <br>Total: {{ $total }}
        </p>
        <form method="post">
            @csrf
            <button class="button">Pay</button>
        </form>
        
    </div>
</x-app-layout>