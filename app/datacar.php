<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datacar extends Model
{
  protected $table = 'datacars';
  protected $fillable = ['IDCard_car','Brand_car','Version_car','Year_car','Regis_car','OpenBit_car','CloseBit_car','Note_car','Image_car'];
}
