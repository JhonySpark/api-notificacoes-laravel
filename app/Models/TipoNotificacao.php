<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoNotificacao
 *
 * @property $id
 * @property $id_usuario
 * @property $nome_tipo
 * @property $created_at
 * @property $updated_at
 *
 * @property Usuario $usuario
 * @property Notificacao[] $notificacoes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TipoNotificacao extends Model
{
    protected $table = 'tipo_notificacao';

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_usuario', 'nome_tipo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notificacoes()
    {
        return $this->hasMany(Notificacao::class, 'id_tipo_notificacao', 'id');
    }

}
