<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "response_code" => "00",
            "response_status" => "Silahkan cek Email anda untuk melakukan verifikasi.",
            "data" => [
                "user" => [
                    'name' => $this->name,
                    'email' => $this->email,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,
                    'id' => $this->id,
                ]
            ]
        ];
    }
}
