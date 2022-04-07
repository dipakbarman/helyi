<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminaddMoneyModel extends Model
{
    public $timestamps = false;
    protected $table = 'admin_add_money';
    use HasFactory;
}
