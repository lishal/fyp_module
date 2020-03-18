<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    public function getAll()
    {
        return company::orderBy('created_at', 'desc')
               ->get();
    }
}
