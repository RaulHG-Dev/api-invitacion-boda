<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComentariosInvitado extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'comentarios_invitados';

    protected $fillable = [
        'nombre',
        'comentario',
        'id_invitado'
    ];
}
