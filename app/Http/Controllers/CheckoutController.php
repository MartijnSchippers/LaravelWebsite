<?php

namespace App\Http\Controllers;

use App\Events\UserBoughtCourse;
use App\Models\Course;
use App\Models\CoursesUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout()
    {
        \Cart::session(auth()->user()->id);
        $total = \Cart::getTotal();
        return view('checkout', ['total' => $total]);
    }

    public function pay(Request $request)
    {
        // there is no room for paymentlogic at this point, so it is assumed
        // that the payment had succeeded

        // add courses to user account
        $user = auth()->user();
        $userId = $user->id;
        \Cart::session($userId);
        $items = \Cart::getContent();
        // trigger event so admin gets to know that event is bought
        // event(new UserBoughtCourse($user->name));
        foreach ($items as $item)
        {
            $publicationId = $item->id;
            // // check if user already has item
            if (! $user->hasPublication($publicationId))
                // give user access to publication
                $user->giveAccessToPublication($item->id);

            //delete item from cart
            \Cart::remove($publicationId);

            $this->sendNotification($request, 'user ' . $user->name . ' has bought the course ' . $item->name);
        }

        return view('thank-you');
    }

    private static function sendNotification(Request $request, $message)
    {
        DB::table('admin_notifications')->insert(['message' => $message]);
        session()->flash('success', 'Congratualions with the new course!');
    }
}
