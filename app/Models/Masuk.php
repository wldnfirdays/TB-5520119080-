<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    protected $table = 'masuks';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'char';

    public static function getDataMasuks()
    {

        $masuks = Masuk::all();
        $masuks_filter = [];
        $no = 1;

        for ($i = 0; $i < $masuks->count(); $i++) {
            $masuks_filter[$i]['no'] = $no++;
            $masuks_filter[$i]['name'] = $masuks[$i]->name;
            $masuks_filter[$i]['qty'] = $masuks[$i]->qty;
            $masuks_filter[$i]['created_at'] = $masuks[$i]->created_at;
            
        }

        return $masuks_filter;
    }
}
