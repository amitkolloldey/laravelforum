<?php
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'confirmed' => 1
    ];
});

$factory->define(App\Topic::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'details' => $faker->paragraph,
        'user_id' => rand(1, 50),
        'best_answer' => rand(1, 20),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->paragraph,
        'user_id' => rand(1, 50),
        'commentable_id' => rand(1, 100),
        'commentable_type' => $faker->randomElement(['App\Comment', 'App\Topic']),
    ];
});

////$factory->define(App\Comment::class, function (Faker\Generator $faker) {
////    return [
////        'body' => $faker->paragraph,
////        'user_id' => function(){
////            return factory('App\User')->create()->id;
////        },
////        'commentable_id' => function(){
////            return factory('App\Comment')->create()->id;
////        },
////        'commentable_type' => 'App\Comment'
////    ];
////});
//
//$factory->define(App\Like::class, function (Faker\Generator $faker) {
//    return [
//        'body' => $faker->paragraph,
//        'user_id' => function(){
//            return factory('App\User')->create()->id;
//        },
//        'likeable_id' => function(){
//            return factory('App\Topic')->create()->id;
//        },
//        'likeable_type' => 'App\Topic'
//    ];
//});
