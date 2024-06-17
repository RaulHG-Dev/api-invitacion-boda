<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DynamicData extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'dynamic_data';

    protected $fillable = [
        'key',
        'value'
    ];
}
