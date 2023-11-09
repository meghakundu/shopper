<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spell extends Model
{
    use HasFactory;
    protected $table = "spells";
    protected $guarded = [];
}
