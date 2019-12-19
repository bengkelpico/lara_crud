<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id_product';
    public $fillable = ['merk', 'harga', 'stok', 'gbr_product'];
}
