<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materials';

    public $fillable = [
        'id',
        'name',
        'price',
        'image',
        'description',
        'expiration_date',
        'manufacture_date',
        'category_id',
        'unit_id',
        'quantity',
        'information',
        'status',

    ];
}
