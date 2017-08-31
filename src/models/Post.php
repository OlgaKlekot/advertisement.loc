<?php
namespace app\src\models;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    public $timestamps = false;
}