<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Imports extends Model
{
    protected $collection = 'imports';
    protected $connection = 'mongodb';

    public function getCredentials($id)
    {
        $import = self::find($id);
        if (!$import){
            abort (404,"Full data scan is running");
        }
        return $import;
    }
}