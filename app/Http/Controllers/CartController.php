<?php

namespace App\Http\Controllers;

// use App\Models\Course;
use App\Models\Publication;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $publication = Publication::find($request->course);
        // check if user already has publication:
        if (auth()->user()->hasPublication($publication->id))
            return ["User already has access to this course"];

        \Cart::session(auth()->user()->id);

        // add to cart
        \Cart::remove($publication->id);
        \Cart::add([
            'id' => $publication->id,
            'name' => $publication->course->title,
            'price' => $publication->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $publication
        ]);

        return view('courses', ['publifications' => Publication::all()]);
    }

    public function viewCartItems(Request $request)
    {
        \Cart::session(auth()->user()->id);
        return view('shopping-cart', ['items' => \Cart::getContent()]);
    }
}
