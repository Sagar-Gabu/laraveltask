<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'slug',
        'category_id',
        'description',
        'price',
        'image',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
