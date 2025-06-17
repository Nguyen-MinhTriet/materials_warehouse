<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class import_receipt extends Model
{
    use HasFactory;
    protected $table = 'import_receipts';
    protected $fillable = [
        'id',
        'employee_id',
        'warehouse_id',
        'supplier_id',
        'issued_date', // NgayLap → issued_date
        'total_amount', // Tong_Tien → total_amount
        'status',
    ];


    public function details()
    {
        return $this->hasMany(import_receipt_detail::class, 'import_receipt_id', 'id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

}
