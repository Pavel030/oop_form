<?php

namespace App\services;

trait HashTrait
{
    public function hash($value)
    {
        if ($value){
            $bytes = random_bytes(16);
            $info = pathinfo($value);
            $sha = sha1($bytes . $info['filename']);
            $value = $sha . '.' . $info['extension'];
            return $value;
        }
        return null;
    }
}