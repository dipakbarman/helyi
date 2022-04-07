<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alltransition extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'all_t_log';
}
