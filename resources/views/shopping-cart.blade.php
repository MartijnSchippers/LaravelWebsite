<x-app-layout>
    <x-slot name="header">
        {{ __('Courses') }}
    </x-slot>

    <div class="container">
        @forelse ($items as $item)
            <h1>{{ $item->associatedModel->course->title }}</h1>
        @empty
            <h1>The shopping cart is empty</h1>
        @endforelse
        <form action="my-cart" method="POST">
            <a class="button" href="/checkout">Checkout</a>
        </form>
    </div>
</x-app-layout>