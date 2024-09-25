<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class Usuario
 *
 * @property $id
 * @property $nome
 * @property $sobrenome
 * @property $email
 * @property $senha
 * @property $created_at
 * @property $updated_at
 *
 * @property Notificacao[] $notificacoes
 * @property TipoNotificacao[] $tiposNotificacaos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Usuario extends Model implements AuthenticatableContract, JWTSubject
{
    use Authenticatable;
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nome', 'sobrenome', 'email', 'senha'];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'senha' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notificacoes()
    {
        return $this->hasMany(\App\Models\Notificacao::class, 'id', 'id_usuario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tiposNotificacaos()
    {
        return $this->hasMany(\App\Models\TipoNotificacao::class, 'id', 'id_usuario');
    }
}
