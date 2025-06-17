<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class batch extends Model
{
    use HasFactory;

    protected $table = 'batches';
    protected $fillable = [
        'id',
        'name',
        'material_id',
        'import_receipt_id',
        'import_quantity',
        'import_price', // NgayLap → issued_date
        'import_date',  // id_ptthanhtoan → payment_methods
        'stock_quantity', // Tong_Tien → total_amount
    ];
}
