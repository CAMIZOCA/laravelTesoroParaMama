<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\View\View;

class InstructionsController extends Controller
{
    public function index(): View
    {
        $defaults = PageContent::defaults();
        $saved    = PageContent::all_settings();
        $c        = array_merge($defaults, $saved);

        return view('instrucciones', compact('c'));
    }
}
