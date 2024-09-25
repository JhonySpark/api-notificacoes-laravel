<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificacaoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'idUsuario' => $this->id_usuario,
            'idTipoNotificacao' => $this->id_tipo_notificacao,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'corpo' => $this->corpo,
            'imagem' => $this->imagem,
            'criado' => $this->created_at,
            'atualizado' => $this->updated_at,
        ];
    }

    public static function toFormatted($object)
    {
        return (object) [
            'id' => $object->id,
            'idUsuario' => $object->id_usuario,
            'idTipoNotificacao' => $object->id_tipo_notificacao,
            'titulo' => $object->titulo,
            'descricao' => $object->descricao,
            'corpo' => $object->corpo,
            'imagem' => $object->imagem_destaque,
            'criado' => $object->created_at,
            'atualizado' => $object->updated_at,
        ];
    }

    public static function collection($collection)
    {
        $formatted = [];
        foreach ($collection as $object) {
            $formatted[] = self::toFormatted($object);
        }
        return $formatted;
    }
}
