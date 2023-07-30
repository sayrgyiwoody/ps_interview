<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'owner_id',
        'price',
        'desc',
        'condition',
        'type',
        'publish_status',
        'location',
        'image',
    ];
}
