<?php

namespace DDApp;

use Illuminate\Database\Eloquent\Model;

class Itemborder extends Model
{
    protected $table = "itemborders";

    protected $fillable = [
        'parent_sku',
        'yellow_border',
        'red_border'
    ];
}
