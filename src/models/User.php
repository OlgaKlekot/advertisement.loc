<?php
namespace app\src\models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    public $timestamps = false;
}