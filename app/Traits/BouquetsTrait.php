<?php
namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait BouquetsTrait
{
    private $url;

    public function __construct()
    {
        $this->url = env('API_BASE_URL');
    }

    public function getBouquets($getUri = 'bouquets')
    {
        return $data = Http::get($this->url . $getUri)->json();
    }
}
