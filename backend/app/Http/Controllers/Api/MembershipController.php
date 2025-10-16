<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Membership::all();

        return response()->json([
            'message' => 'Plans fetched successfully',
            'plans' => $plans
        ], 201);
    }

    public function subscribe(Request $request)
    {
        $user = auth()->user();
        $priceId = $request->price_id;

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkout = Session::create([
            'customer_email' => $user->email,
            'line_items' => [[
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost:5173/membershipSuccess?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://localhost:5173/cancel',
        ]);

        return response()->json(['url' => $checkout->url]);
    }

    public function confirm(Request $request)
    {
        $userData = auth()->user();
        $user = User::find($userData['id']);
        $sessionId = $request->session_id;

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        if ($session->payment_status === 'paid') {
            
            $user->membership_plan_id = 1; 
            $user->subscribed_at = now();
            $user->save();

            return response()->json(['message' => 'Payment confirmed']);
        }

        return response()->json(['message' => 'Payment not confirmed'], 400);
    }

    public function webhook(Request $request)
    {
        $payload = @file_get_contents('php://input');
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? null;
        $secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $secret
            );
        } catch (\UnexpectedValueException $e) {
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Exemplo: evento de pagamento concluído
        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $email = $session->customer_email;

            $user = User::where('email', $email)->first();
            if ($user) {
                $user->membership_plan_id = 1; // ou deduzir pelo price_id
                $user->subscribed_at = now();
                $user->save();
            }
        }

        return response()->json(['status' => 'success']);
    }


}
