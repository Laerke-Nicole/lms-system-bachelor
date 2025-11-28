<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AbInventech;
use App\Models\Gdpr;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function privacyPolicy()
    {
        $gdprs = Gdpr::orderBy('created_at')->get();
        $abInventech = AbInventech::latest()->first();

        return view('gdprs.privacy-policy', compact('gdprs', 'abInventech'))->with(request()->input('page'));
    }
}
