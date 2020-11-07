<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VerifyOTPResource extends JsonResource
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
                "response_status" => "Verifikasi OTP Berhasil",
                "data" => [
                    "user" => [
                        'id' => $this->id,
                        'name' => $this->name,
                        'email' => $this->email,
                        'photo' => $this->photo,
                        'email_verified_at' => $this->email_verified_at,
                        'created_at' => $this->created_at,
                        'updated_at' => $this->updated_at,
                    ]
                ]
            ];
    }
}
