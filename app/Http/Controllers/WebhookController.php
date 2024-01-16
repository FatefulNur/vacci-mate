<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VaccineCenter;

class WebhookController extends Controller
{
    public function register(Request $request)
    {
        $vaccineCenter = VaccineCenter::firstWhere('name', 'like', "%{$request->input('vaccine_center')}%");

        return $vaccineCenter->users()->create($request->except('vaccine_center'));
    }
}
