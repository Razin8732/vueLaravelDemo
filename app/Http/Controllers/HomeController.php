<?php

namespace App\Http\Controllers;

use App\Traits\BouquetsTrait;
use Inertia\Inertia;

class HomeController extends Controller
{
    use BouquetsTrait;
    /**
     * Show the application dashboard.
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Home', [
            'event' => [
                'title' => 'Welcome to Inertia!',
                'description' =>
                'This is a simple example of a component rendered on the server side.',
            ],
        ]);
    }
}
