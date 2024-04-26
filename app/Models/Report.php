<?php

namespace App\Models;

use App\Models\Authority;
use App\Models\Category;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'detail',
        'date',
        'photo',
        'user_id',
        'category_id',
        'authority_id',
        'status_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
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
    
    public function response()
    {
        return $this->hasMany(Response::class, 'response_id');
    }
}
