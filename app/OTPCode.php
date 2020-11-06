<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OTPCode extends Model
{
    protected $table = 'otp_code_tables';

    protected  $primaryKey = 'user_id';

    protected $fillable = [
        'user_id', 'kode_otp',
    ];

    public function user()
    {
        return $this->belongsTo("App\User");
    }

}
