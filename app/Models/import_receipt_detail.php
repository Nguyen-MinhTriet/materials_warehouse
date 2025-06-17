<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class import_receipt_detail extends Model
{
    use HasFactory;
    protected $table = 'import_receipt_details';
    protected $fillable = [
        'id',
        'import_receipt_id',
        'material_id',
        'quantity',
        'total_amount', 
    ];
    public function importReceipt()
    {
        return $this->belongsTo(import_receipt::class, 'export_receipt_id');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    // Bạn có thể thêm các quan hệ khác nếu cần:

}
