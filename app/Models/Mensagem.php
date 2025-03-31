<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{

    protected $table = 'mensagens';

    protected $fillable = [
        'mensagem',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
