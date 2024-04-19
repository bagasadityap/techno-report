<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'reporter',
        'detail',
        'date',
        'photo',
        'category_id',
        'authority_id',
        'status_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function authority()
    {
        return $this->belongsTo(Authority::class, 'authority_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
