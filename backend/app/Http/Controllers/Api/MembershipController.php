<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Membership;

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
        $plans = Membership::all();

        return response()->json([
            'message' => 'Plans fetched successfully',
            'plans' => $plans
        ], 201);
    }


}
