<?php
namespace app\src\controllers\posts;
use function app\core\renderView;
use function app\core\redirect;
use function app\core\addFlash;
use app\src\models\Category;
use app\src\models\Post;


function index()
{
    $categories = Category::select('categories.*')->groupBy('categories.id')->get()->toArray();

    if (isset($_GET['category'])) {
        $posts = Post::select('posts.*', 'categories.category', 'users.username')->leftJoin('users', 'users.id', '=', 'posts.user_id')->leftJoin('categories', 'categories.id', '=', 'posts.category_id')->where('categories.category', '=', $_GET['category'])->groupBy('posts.id')->orderBy('posts.created_at', 'DESC')->get()->toArray();
    } else {
        $posts = Post::select('posts.*', 'categories.category', 'users.username')->leftJoin('users', 'users.id', '=', 'posts.user_id')->leftJoin('categories', 'categories.id', '=', 'posts.category_id')->groupBy('posts.id')->orderBy('posts.created_at', 'DESC')->get()->toArray();
    }

    return renderView(['template.php', 'posts/main.php'], ['posts' => $posts, 'categories' => $categories]);
}


function definitePost($postN)
{
    $posts = Post::select('posts.*', 'categories.category', 'users.username')->leftJoin('users', 'users.id', '=', 'posts.user_id')->leftJoin('categories', 'categories.id', '=', 'posts.category_id')->where('posts.title', '=', urldecode($postN))->get()->toArray();

    return renderView(['template.php', 'posts/definite_post.php'], ['posts' => $posts]);
}


function userCabinetIndex() {
    $categories = Category::select('categories.*')->groupBy('categories.id')->get()->toArray();
    global $app;

    if (isset($_GET['category'])) {
        $posts = Post::select('posts.*', 'categories.category', 'users.username')->leftJoin('users', 'users.id', '=', 'posts.user_id')->leftJoin('categories', 'categories.id', '=', 'posts.category_id')->where('categories.category', '=', $_GET['category'])->where('users.id', '=', $app['user']['id'])->groupBy('posts.id')->orderBy('posts.created_at', 'DESC')->get($app['user']['id'])->toArray();
    } else {
        $posts = Post::select('posts.*', 'categories.category', 'users.username')->leftJoin('users', 'users.id', '=', 'posts.user_id')->leftJoin('categories', 'categories.id', '=', 'posts.category_id')->where('users.id', '=', $app['user']['id'])->groupBy('posts.id')->orderBy('posts.created_at', 'DESC')->get()->toArray();
    }

    return renderView(['template.php', 'users/user_cabinet.php'], ['posts' => $posts, 'categories' => $categories]);
}


function addPostIndex() {
    $categories = Category::select('*')->groupBy('id')->get()->toArray();

    return renderView(['template.php', 'posts/add_post.php'], ['categories' => $categories]);
}


function addPost() {
    global $app;
    if (!empty($_POST['adding'])) {
        Post::insert(['title' => $_POST['title'], 'price' => $_POST['price'], 'main' => $_POST['text'], 'category_id' => $_POST['category'], 'user_id' => $app['user']['id']]);

        addFlash('info', 'Post "' . $_POST['title'] . '" was added!');
        redirect('user_cabinet');
    }
}


function editPostIndex() {
    $categories = Category::select('*')->groupBy('id')->get()->toArray();

    if (isset($_GET['edit'])) {
        $edit_post = Post::select('posts.*', 'categories.category', 'users.username')->leftJoin('users', 'users.id', '=', 'posts.user_id')->leftJoin('categories', 'categories.id', '=', 'posts.category_id')->where('posts.id', '=', $_GET['edit'])->get()->toArray();
    }
    return renderView(['template.php', 'posts/edit_post.php'], ['edit_post' => $edit_post, 'categories' => $categories]);
}

function saveEditPost($edit_id) {
    if (!empty($_POST['save'])) {
        Post::where('id', '=', $edit_id)->update(['title' => $_POST['title'], 'price' => $_POST['price'], 'main' => $_POST['text'], 'category_id' => $_POST['category']]);

        addFlash('info', 'Post "' . $_POST['title'] . '" was edited!');
        redirect('user_cabinet');
    }
}

function deletePost() {
    Post::where('title', '=', $_GET['delete'])->delete();

    addFlash('info', 'Post "' . $_GET['delete'] . '" was deleted!');
    redirect('user_cabinet');
}

