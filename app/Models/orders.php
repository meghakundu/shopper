<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $guarded = [];
    public function company()
    {
        return $this->belongsTo('App\Models\User','customer_id','id');
    }
}
