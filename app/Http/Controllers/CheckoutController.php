<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CoursesUser;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        \Cart::session(auth()->user()->id);
        $total = \Cart::getTotal();
        return view('checkout', ['total' => $total]);
    }

    public function pay()
    {
        // there is no room for paymentlogic at this point, so it is assumed
        // that the payment had succeeded

        // add courses to user account
        $userId = auth()->user()->id;
        \Cart::session($userId);
        $items = \Cart::getContent();
        foreach ($items as $item)
        {
            // check if user already has item
            $course = Course::find($item->id);
            if (! $course->users()->where('user_id', $userId)->exists() )
            {
                // add item to stock user
                CoursesUser::create(['user_id' => $userId, 'course_id' => $course->id]);
            }

            //delete item from cart
            \Cart::remove($course->id);
        }

        return view('thank-you');
    }
}
