<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    //
    protected $table = 'register';
    protected $primaryKey ='registerID';
    public $timestamps =false;
    protected $fillable =['username','passwords','email'];
}
