<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundstransferlogmodel extends Model
{
    public $timestamps = false;
    protected $table = 'funds_transfer_log';
    use HasFactory;
}
