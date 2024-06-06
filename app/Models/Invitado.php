<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitado extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'invitados';

    protected $fillable = [
        'nombre_invitado',
        'numero_invitados',
        'uuid_invitado'
    ];
}
