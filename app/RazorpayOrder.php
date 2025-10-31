<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;

class RazorpayOrder extends Model
{

    protected $table = 'rozorpay_orders';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];

}
