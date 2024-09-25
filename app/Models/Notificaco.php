<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notificacao
 *
 * @property $id
 * @property $id_usuario
 * @property $id_tipo_notificacao
 * @property $titulo
 * @property $descricao
 * @property $corpo
 * @property $imagem_destaque
 * @property $created_at
 * @property $updated_at
 *
 * @property TipoNotificacao $tipoNotificacao
 * @property Usuario $usuario
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Notificacao extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_usuario', 'id_tipo_notificacao', 'titulo', 'descricao', 'corpo', 'imagem_destaque'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoNotificacao()
    {
        return $this->belongsTo(\App\Models\TipoNotificacao::class, 'id_tipo_notificacao', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'id_usuario', 'id');
    }

}
