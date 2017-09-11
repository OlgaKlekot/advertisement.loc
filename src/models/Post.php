<?php
namespace app\src\models;
use Illuminate\Database\Eloquent\Model;
//use app\src\models\User;

class Post extends Model
{
    protected $table = 'posts';
    public $timestamps = false;
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function type()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}