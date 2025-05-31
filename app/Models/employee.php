<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone' ,
        'address',
        'position',
        'contract' ,
        'gender' , // 0: Nữ, 1: Nam
        'birth_date',
        'status' , // 0: Không hoạt động, 1: Hoạt động
        'warehouse_id',
    ];


    public function warehouse()
    {
        return $this->belongsTo(warehouse::class);
        // lấy tên kho 
    }
}
