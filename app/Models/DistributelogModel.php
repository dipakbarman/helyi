<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributelogModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'distribute_logs';
}
