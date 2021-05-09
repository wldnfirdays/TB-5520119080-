<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluar extends Model
{
    protected $table = 'keluars';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'char';
}
