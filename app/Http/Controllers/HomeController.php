<?php

namespace App\Http\Controllers;

use App\Traits\ApiTrait;
use App\Traits\BouquetsTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    use BouquetsTrait;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('home');
        return Inertia::render('Home', [
            'event' => [
                'title' => 'Welcome to Inertia!',
                'description' =>
                    'This is a simple example of a component rendered on the server side.',
            ],
        ]);
    }

    /**
     * Show the Demo 2.
     *
     */
    public function demo2()
    {
        $bouquets = $this->getBouquets();
        return Inertia::render('Demo2', [
            'bouquets' => $bouquets,
        ]);
    }
}
