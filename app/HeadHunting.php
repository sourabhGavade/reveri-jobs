<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeadHunting extends Model
{
    protected $table = 'head_hunting';
    public $timestamps = true;
    protected $guarded = ['id'];
    protected $fillable = [];
    protected $dates = ['created_at', 'updated_at'];
}
