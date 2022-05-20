<?php

namespace App\Http\Controllers;

use App\Traits\BouquetsTrait;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Redirect;

class BouquetController extends Controller
{
    use BouquetsTrait;

    /**
     * Show the Bouquets listing from api .
     * @return \Inertia\Response
     */
    public function index()
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
    public function show($bouquetId)
    {
        return response()->json($this->getBouquets($bouquetId));
    }

    /**
     * Create new bouquet from api .
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'image' => ['required', 'url', function ($attribute, $value, $fail) {
                if (!(@getimagesize($value))) {
                    $fail('The image url is not valid.');
                }
            }],
        ]);
        $response = $this->createBouquet($request->all());
        if ($response->status() == 201) {
            return response()->json(['success' => true, 'msg' => 'Bouquet created successfully'], 201);
        } else {
            return response()->json(['success' => false, 'msg' => 'Bouquet creation failed'], 201);
        }
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
            return response()->json(['success' => true, 'msg' => 'Bouquet deleted successfully',]);
        } else {
            return response()->json(['success' => false, 'msg' => 'Bouquet not deleted',]);
        }
    }
}
