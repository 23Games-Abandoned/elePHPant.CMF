<?php

$app->get('/p', function() use ($app){
	$app->redirect($app->urlFor('home'));
})->name('gepa');

$app->get('/p/:id', function($id) use ($app){
	$page = $app->pages->where('meta_name',$id)->leftJoin('autor','users.id','page.author')->get();
	//$page = $app->pages->whereId($id)->whereHas('user', function($query) use($id) { $query->whereId($id) })->first();
    var_dump($page);
    if (!$page){
        $app->notFound();
    }

    $app->render('pages/page.twig',[
        'page'  =>  $page
    ]);
})->name('page.choose');