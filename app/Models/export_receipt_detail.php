<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class export_receipt_detail extends Model
{
    use HasFactory;

    protected $table = 'export_receipt_details';
    protected $fillable = [
        'id',
        'export_receipt_id',
        'material_id',
        'quantity', // NgayLap → issued_date
        'total_price',
        'batch_id',  // id_ptthanhtoan → payment_methods
    ];

    public function exportReceipt()
    {
        return $this->belongsTo(export_receipt::class, 'export_receipt_id');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    // Bạn có thể thêm các quan hệ khác nếu cần:
    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }


}
