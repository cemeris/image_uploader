<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Storage;

class StoreSomeValueController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function storeText($text = 'default') {
        $data = [];
        $data[] = $text;
        Storage::disk('local')->put('data.json', json_encode($data));
        return "value  has been stored";
    }

    public function getText() {
        return Storage::disk('local')->get('data.json');
    }
}
