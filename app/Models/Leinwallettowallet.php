<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leinwallettowallet extends Model
{
    public $timestamps = false;
    protected $table = 'lein_to_wallet_log';
    use HasFactory;
}
