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

    public function getBouquets($id = null)
    {
        if ($id != null) {
            $getUri = $this->uri . $id;
        }
        return $data = Http::get($this->url . $getUri)->json();
    }

    public function deleteBouquet($id)
    {
        return Http::delete($this->url . $this->uri . $id);
    }
}
