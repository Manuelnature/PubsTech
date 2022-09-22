<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Register extends Model
{
    protected $table = 'tbl_users';
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];

    public static function register_user(String $first_name, String $last_name, String $email, String $password)
    {
        $data = array('first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => $password);

                return DB::table('tbl_users')->insert($data);
    }
}
