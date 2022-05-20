<?php

namespace App\Http\Controllers;

use App\Traits\ApiTrait;
use App\Traits\BouquetsTrait;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;

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

    /**
     * Show the Bouquets listing from api .
     * @return \Inertia\Response
     */
    public function bouquets()
    {
        return Inertia::render('Bouquets', [
            'bouquets' => $this->getBouquets(),
        ]);
    }

    /**
     * Get single bouquet from api .
     * @param  int  $bouquetId Id of the bouquet to be fetched.
     * @return \Illuminate\Http\Response
     */
    public function get($bouquetId)
    {
        return response()->json($this->getBouquets($bouquetId));
    }

    /**
     * Delete the Bouquet from api .
     * @param  int  $bouquetId Id of the bouquet to be deleted.
     * @return \Illuminate\Http\Redirect Redirect to bouquets listing.
     */
    public function delete($bouquetId)
    {
        $response = $this->deleteBouquet($bouquetId);
        if ($response->status() == 200) {
            return Redirect::back()->with(['success' => true, 'msg' => 'Bouquet deleted successfully',]);
        } else {
            return Redirect::back()->with(['success' => false, 'msg' => 'Bouquet not deleted',]);
        }
    }
}
