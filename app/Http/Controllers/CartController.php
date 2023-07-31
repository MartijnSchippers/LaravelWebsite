<?php

namespace App\Http\Controllers;

// use App\Models\Course;
use App\Models\Publification;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $publification = Publification::find($request->course);
        // dd($publification->id);
        \Cart::session(auth()->user()->id);
        // \Cart::add([
        //     'id' => 1,
        //     'name' => $publification->course->name,
        //     'price' => $publification,
        //     'quantity' => 1,
        //     'attributes' => array(),
        //     'associatedModel' => $publification,
        // ]);
        \Cart::add([
            'id' => $publification->id,
            'name' => $publification->course->title,
            'price' => $publification->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $publification
        ]);
        return view('courses', ['publifications' => Publification::all()]);
    }

    public function viewCartItems(Request $request)
    {
        \Cart::session(auth()->user()->id);
        return view('shopping-cart', ['items' => \Cart::getContent()]);
    }
}
