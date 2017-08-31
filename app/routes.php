<?php
/**
 * route_name => [path, file, function, methods]
 */

return [
    'definite_post' => [
        'path' => '/{postN}/',
        'file' => 'controllers\posts.php',
        'function' => 'app\\src\\controllers\\posts\\definitePost',
        'methods' => ['GET']
    ],
    'user_cabinet' => [
        'path' => '/my_cabinet',
        'file' => 'controllers\posts.php',
        'function' => 'app\\src\\controllers\\posts\\userCabinetIndex',
        'methods' => ['GET']
    ],
    'main_page' => [
        'path' => '/',
        'file' => 'controllers\posts.php',
        'function' => 'app\\src\\controllers\\posts\\index',
        'methods' => ['GET']
    ],
    'registration' => [
        'path' => '/registration',
        'file' => 'controllers\security.php',
        'function' => 'app\\src\\controllers\\security\\index',
        'methods' => ['GET']
    ],
    'add_user' => [
        'path' => '/add_user',
        'file' => 'controllers\security.php',
        'function' => 'app\\src\\controllers\\security\\addUser',
        'methods' => ['POST']
    ],
    'add_post' => [
        'path' => '/new_post',
        'file' => 'controllers\posts.php',
        'function' => 'app\\src\\controllers\\posts\\addPostIndex',
        'methods' => ['GET']
    ],
    'delete_post' => [
        'path' => '/delete',
        'file' => 'controllers\posts.php',
        'function' => 'app\\src\\controllers\\posts\\deletePost',
        'methods' => ['POST', 'GET']
    ],
    'edit_post' => [
        'path' => '/edit',
        'file' => 'controllers\posts.php',
        'function' => 'app\\src\\controllers\\posts\\editPostIndex',
        'methods' => ['GET']
    ],
    'new_post' => [
        'path' => '/new',
        'file' => 'controllers\posts.php',
        'function' => 'app\\src\\controllers\\posts\\addPost',
        'methods' => ['POST']
    ],
    'save_edit' => [
        'path' => '/save/{edit_id}',
        'file' => 'controllers\posts.php',
        'function' => 'app\\src\\controllers\\posts\\saveEditPost',
        'methods' => ['POST']
    ],
    'security_login' => [
        'path' => '/login',
        'file' => 'controllers\security.php',
        'function' => 'app\\src\\controllers\\security\\login',
        'methods' => ['POST']
    ],
    'security_logout' => [
        'path' => '/logout',
        'file' => 'controllers\security.php',
        'function' => 'app\\src\\controllers\\security\\logout',
        'methods' => ['POST']
    ],
];