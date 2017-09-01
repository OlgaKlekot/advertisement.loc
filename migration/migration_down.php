<?php
include '../app/app.php';
use Illuminate\Database\Capsule\Manager as Capsule;

    Capsule::schema()->drop('users1');
    Capsule::schema()->drop('categories1');
    Capsule::schema()->drop('posts1');
