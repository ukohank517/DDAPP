<?php

namespace DDApp;

use Illuminate\Database\Eloquent\Model;

class Orderdocument extends Model
{
    protected $table = "orderdocuments";

    protected $fillable = [
        'doc_id',
        'order_date',
        'parent_sku',
        'parent_num',
        'price',
        'supplier',
        'price'
    ];
}
