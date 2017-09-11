<?php
namespace app\src\models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;
    public function postsByCategory() {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}