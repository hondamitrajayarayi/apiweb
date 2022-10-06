<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Price;

class Price extends Model
{
    // protected $table="VI_API_PRICES";
    protected $fillable = [		
		'product_name','amounth_price','product_id'
	];
}
