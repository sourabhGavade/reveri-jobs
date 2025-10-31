<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App;
use App\Traits\Lang;
use App\Traits\IsDefault;
use App\Traits\Active;
use App\Traits\Sorted;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use Illuminate\Database\Eloquent\Model;


class Suggested_request extends Model
{
    
    use HasFactory;
    protected $table = 'suggested_request';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at'];
}
