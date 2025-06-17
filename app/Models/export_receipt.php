<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class export_receipt extends Model
{
    use HasFactory;

    protected $table = 'export_receipts';
    protected $fillable = [
        'id',
        'employee_id',
        'warehouse_id',
        'customer_id',
        'issued_date', // NgayLap → issued_date
        'payment_method_id',  // id_ptthanhtoan → payment_methods
        'total_amount', // Tong_Tien → total_amount
        'status',
    ];

    public function details()
    {
        return $this->hasMany(export_receipt_detail::class, 'export_receipt_id', 'id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

}
