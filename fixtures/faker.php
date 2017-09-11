<?php
include '../app/app.php';
use app\src\models\User;
use app\src\models\Post;
use app\src\models\Category;

$faker = Faker\Factory::create();

for ($i = 1; $i < 7; $i++) {
    $user = new User();
    $user->username = $faker->userName();
    $user->password = password_hash('123', PASSWORD_DEFAULT);
    $user->save();
}
for ($i = 1; $i < 5; $i++) {
    $category = new Category();
    $category->category = $faker->word();
    $category->save();

}
for ($i = 1; $i < 10; $i++) {
    $post = new Post();
    $post->title = $faker->sentence(4);
    $post->price = $faker->randomFloat(2, 0.01,9999.99);
    $post->created_at = $faker->dateTimeBetween('-3 years', 'now');
    $post->main = $faker->text(200);
    $post->user_id = User::all()->random()->id;
    $post->category_id = Category::all()->random()->id;
    $post->save();
}

