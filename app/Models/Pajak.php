<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pajak extends Authenticatable
{
    protected $fillable = [
        'id_pajak', 'id_user', 'nama_wp', 'npwp', 'no_hp', 'no_efin', 'gmail', 'password', 
        'nik', 'alamat', 'merk_dagang'
    ];

    // Jika Anda menggunakan hashed password
    protected $hidden = ['password'];

    // Implement the necessary methods from the Authenticatable contract
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
