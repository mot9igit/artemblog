<?php

namespace App\Core\Ports\Storage;


interface StoragePort {
    public function save(FileUploadInput $input);
    public function get(string $key);
    public function remove(string $key);
}
