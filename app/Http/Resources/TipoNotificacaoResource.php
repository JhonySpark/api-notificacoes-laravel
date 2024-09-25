<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TipoNotificacaoResource extends JsonResource
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
            'nome' => $this->nome_tipo,
            'criado' => $this->created_at,
            'atualizado' => $this->updated_at,
        ];
    }

    public static function toFormatted($object)
    {
        return (object) [
            'id' => $object->id,
            'idUsuario' => $object->id_usuario,
            'nome' => $object->nome_tipo,
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
