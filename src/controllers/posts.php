<?php
namespace app\src\controllers\posts;
use function app\core\renderView;
use function app\core\redirect;
use function app\core\addFlash;
use app\src\models\Category;
use app\src\models\Post;
use app\src\models\User;


function index()
{
//    global $categories;
    $postsByCategory = Category::where('category', '=', $_GET['category'])->get()->toArray();
    if (isset($_GET['category'])) {
        $posts = Post::with('author', 'type')
            ->where('category_id', '=', $postsByCategory[0]['id'])
            ->orderBy('posts.created_at', 'DESC')->get()->toArray();
    } else {
        $posts = Post::with('author', 'type')
            ->orderBy('posts.created_at', 'DESC')->get()->toArray();
    }
    return renderView(['template.php', 'posts/main.php'], ['posts' => $posts]);
}


function definitePost($postN)
{
    $posts = Post::with('author', 'type')
        ->where('posts.title', '=', urldecode($postN))
        ->orderBy('posts.created_at', 'DESC')->get()->toArray();
    return renderView(['template.php', 'posts/definite_post.php'], ['posts' => $posts]);
}


function userCabinetIndex()
{
    global $app;

    $postsByUser = User::where('users.id', '=', $app['user']['id'])->get()->toArray();
    $postsByCategory = Category::where('category', '=', $_GET['category'])->get()->toArray();

    if (isset($_GET['category'])) {

        $posts = Post::with('author', 'type')
            ->where('user_id', '=', $postsByUser[0]['id'])
            ->where('category_id', '=', $postsByCategory[0]['id'])
            ->orderBy('posts.created_at', 'DESC')->get()->toArray();
    } else {

        $posts = Post::with('author', 'type')
            ->where('user_id', '=', $postsByUser[0]['id'])
            ->orderBy('posts.created_at', 'DESC')->get()->toArray();
    }
    return renderView(['template.php', 'users/user_cabinet.php'], ['posts' => $posts]);
}



function addPostIndex()
{
    $categories = Category::select('*')->groupBy('id')->orderBy('category')->get()->toArray();

    return renderView(['template.php', 'posts/add_post.php'], ['categories' => $categories]);
}


function addPost()
{
    global $app;
    if (!empty($_POST['adding'])) {
        Post::insert(['title' => $_POST['title'], 'price' => $_POST['price'], 'main' => $_POST['text'], 'category_id' => $_POST['category'], 'user_id' => $app['user']['id']]);

        addFlash('info', 'Post "' . $_POST['title'] . '" was added!');
        redirect('user_cabinet');
    }
}


function editPostIndex()
{
    $categories = Category::select('*')->groupBy('id')->orderBy('category')->get()->toArray();
    $edit_post = Post::where('posts.id', '=', $_GET['edit'])->get()->toArray();
    return renderView(['template.php', 'posts/edit_post.php'], ['edit_post' => $edit_post[0], 'categories' => $categories]);
}

function saveEditPost($edit_id)
{
    if (!empty($_POST['save'])) {
        Post::where('id', '=', $edit_id)->update(['title' => $_POST['title'], 'price' => $_POST['price'], 'main' => $_POST['text'], 'category_id' => $_POST['category']]);

        addFlash('info', 'Post "' . $_POST['title'] . '" was edited!');
        redirect('user_cabinet');
    }
}

function deletePost()
{
    Post::where('posts.title', '=', $_GET['delete'])->delete();

    addFlash('info', 'Post "' . $_GET['delete'] . '" was deleted!');
    redirect('user_cabinet');
}

