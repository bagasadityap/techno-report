<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        "name",
        "description",
        "date",
        "image",
        "report_id",
        "user_id",
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function report()
	{
		return $this->belongsTo(Report::class, 'report_id', 'id');
	}
}
