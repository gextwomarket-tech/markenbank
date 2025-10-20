<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $appName = Setting::getValue('app_name', 'Marken Bank');
        $appTagline = Setting::getValue('app_tagline', 'Votre banque digitale de confiance');
        $supportedCurrencies = Setting::getValue('supported_currencies', ['USD', 'EUR', 'XOF']);
        
        return view('landing', compact('appName', 'appTagline', 'supportedCurrencies'));
    }
}
