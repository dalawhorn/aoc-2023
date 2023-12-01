<?php
namespace App\Console\Commands\Aoc;

use Illuminate\Support\Facades\Storage;

trait AocHelpersTrait {
    public function openAocFile($file_name) {
        $file_path = '/aoc-inputs/'.$file_name.'.txt';
        if(Storage::exists($file_path)) {
            return explode("\n", Storage::get($file_path));
        }
        else {
            echo "file not found";
        }
    }
}