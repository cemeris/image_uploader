<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ImageController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
        return response()->json([
            "status" => true
        ], 200);
    }

    public function get($id) {
        return response()->json([
            "status" => true,
            "id" => $id,
            "message" => "get action"
        ], 200);
    }

    public function add() {
        $groupByEntry = function (&$arr) {
            $first_value = current($arr);
            if (is_array($first_value)) {
                $entry = [];
                $count = count($first_value);
            
                foreach ($arr as $key => $column_values) {
                    for ($i = 0; $i < $count; $i++) {
                        $entry[$i][$key] = $column_values[$i];
                    }
                }
            
                $arr = $entry;
            }
            else {
                $arr = [$arr];
            }
        };

        /*
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        }
        */

        $target_dir = __DIR__ . '/uploads';

        $images = $_FILES['images'];
        $groupByEntry($images);

        $count = 0;

        foreach ($images as $image) {
            $target_file = $target_dir . basename($image["name"]);
            $image_file_type = strtolower(pathinfo($target_file ,PATHINFO_EXTENSION));
            $size = getimagesize($image["tmp_name"]);
            if ($size) {
                $count++;
                Storage::disk('local')->put($image['name'], file_get_contents($image['tmp_name']));
            }
        }

        $output = [
            "status" => true,
            "message" => "add action",
            "data" => $_POST,
            "files" => $images,
            'count' => $count,
        ];

        return response()->json($output, 200);
    }
}
