<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id', 'product_id', 'product_qty', 'product_price', 'net_amount', 'discount', 'gross_amount', 'date', 'status', 'code'];
}
