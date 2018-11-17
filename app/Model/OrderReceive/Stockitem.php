<?php

namespace DDApp\Model\OrderReceive;

use Illuminate\Database\Eloquent\Model;

class Stockitem extends Model
{
    protected $table = "stockitems";

    protected $fillable = [
        'parent_sku',
        'stock_num',
        'price',
        'place'
    ];
}
