<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $table= 'estimates';
    protected $primaryKey = 'id';
    protected $fillable = ['type',
                         'operationCost',
                         'tax',
                         'customsCost',
                         'lastMileCost',
                         'exchangeRate',
                         'total'  ];
}
