<?php
/**
 * Author: PanOtlet
 */

$app->get('/admin', $admin(), function() use ($app){
    $app->render('admin/admin.twig');
})->name('admin.dashboard');