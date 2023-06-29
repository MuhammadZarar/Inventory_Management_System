<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_no', 'name', 'contact', 'date', 'sub_total', 'sub_discount', 'grand_total', 'status', 'code'];
}
