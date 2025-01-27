<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class stripeWebhookController extends Controller
{
    //
    public function handleWebhook(){
        return response()->json(['status'=> 'success'], 200);
    }
}
