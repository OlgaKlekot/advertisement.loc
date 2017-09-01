<?php
include '../app/app.php';
use Illuminate\Database\Capsule\Manager as Capsule;


Capsule::schema()->create('users1', function (Illuminate\Database\Schema\Blueprint $table) {
    $table->increments('id')->unsigned();
    $table->string('username')->unique()->charset('utf8');
    $table->string('password')->charset('utf8');
});

Capsule::schema()->create('posts1', function (Illuminate\Database\Schema\Blueprint $table) {
    $table->increments('id');
    $table->string('title')->charset('utf8');
    $table->float('price')->dafault(Capsule::raw(NULL));
    $table->text('main')->charset('utf8');
    $table->timestamp('created_at')->default(Capsule::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
    $table->integer('user_id')->unsigned();
    $table->integer('category_id')->unsigned();
});

Capsule::schema()->create('categories1', function (Illuminate\Database\Schema\Blueprint $table) {
    $table->increments('id');
    $table->string('category')->charset('utf8');
});