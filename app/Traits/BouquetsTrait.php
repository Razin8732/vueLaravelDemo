<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait BouquetsTrait
{
    private $url;
    private $uri;

    public function __construct()
    {
        $this->url = env('API_BASE_URL');
        $this->uri = '/bouquets/';
    }

    public function getBouquets($id = '')
    {
        return array_reverse(Http::get($this->url . $this->uri . $id)->json());
    }

    public function deleteBouquet($id)
    {
        return Http::delete($this->url . $this->uri . $id);
    }

    public function createBouquet($data)
    {
        return Http::post($this->url . $this->uri, $data);
    }
}
