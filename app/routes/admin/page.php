<?php
/**
 * Author: PanOtlet
 */

$app->get('/admin/page', $admin(), function() use ($app){
    $app->render('admin/page.twig');
})->name('admin.page');