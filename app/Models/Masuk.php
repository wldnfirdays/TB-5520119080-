<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    protected $table = 'masuks';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'char';
}
