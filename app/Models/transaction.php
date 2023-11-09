<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $guarded = [];
    public function orderData()
    {
        return $this->belongsTo('App\Models\orders','order_id','id');
    }
    public function paymentTypes(){
        return $this->belongsTo('App\Models\paymentGateway','payment_gateway_id','id');

    }

    public function bankData()
    {
        return $this->hasOne(banks::class,'transaction_id','id');
    }
}
