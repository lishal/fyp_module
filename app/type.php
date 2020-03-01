<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    public function getAll()
    {
        return Type::orderBy('created_at', 'desc')
               ->get();
    }
}
