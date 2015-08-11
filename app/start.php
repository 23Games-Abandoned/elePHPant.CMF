<?php
/**
 * Author: PanOtlet
 */

/*
 * Used Libs
 */
//Slim
use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

//External
use Noodlehaus\Config;
use RandomLib\Factory as RandomLib;

//Own
use Elephpant\User\User;
use Elephpant\Functions\Pages;
use Elephpant\Helpers\Hash;
use Elephpant\Helpers\Update;
use Elephpant\Mail\Mailer;
use Elephpant\Validation\Validator;
use Elephpant\Middleware\BeforeMiddleware;
use Elephpant\Middleware\CsrfMiddleware;

session_cache_limiter(false);
session_start();

ini_set('display_errors', 'On');

define('INC_ROOT', dirname(__DIR__));

require INC_ROOT.'/libs/autoload.php';

$app = new Slim([
    'mode'              =>  file_get_contents(INC_ROOT.'/mode.php'),
    'view'              =>  new Twig(),
    'templates.path'    =>  INC_ROOT.'/app/views'
]);

$app->add(new BeforeMiddleware);
$app->add(new CsrfMiddleware);

$app->configureMode($app->config('mode'), function() use ($app){
    $app->config    =   Config::load(INC_ROOT."/app/config/{$app->mode}.php");
});

require "lang/{$language}.lang.php";
require 'database.php';
require 'filters.php';
require 'routes.php';

$app->auth = false;

$app->container->set('user', function() {
    return new User;
});

$app->container->set('pages', function() {
    return new Pages;
});

$app->container->singleton('hash', function() use ($app) {
    return new Hash($app->config);
});

$app->container->singleton('validation', function() use ($app){
    return new Validator($app->user, $app->hash, $app->auth);
});

$app->container->singleton('update', function() use ($app){
    return new Update;
});

$app->container->singleton('mail', function() use($app){
    $mailer = new PHPMailer;

    $mailer->IsSMTP();
    $mailer->Host       =   $app->config->get('mail.host');
    $mailer->SMTPAuth   =   $app->config->get('mail.auth');
    $mailer->SMTPSecure =   $app->config->get('mail.secure');
    $mailer->Port       =   $app->config->get('mail.port');
    $mailer->Username   =   $app->config->get('mail.username');
    $mailer->Password   =   $app->config->get('mail.password');

    $mailer->isHTML($app->config->get('mail.html'));

    return new Mailer($app->view, $mailer);
});

$app->container->singleton('randomLib', function(){
    $factory = new RandomLib;
    return $factory->getMediumStrengthGenerator();
});

$view = $app->view();
$view->parserOptions = [
    'debug' =>  $app->config->get('twig.debug')
];
$view->parserExtensions = [
    new TwigExtension,
];
$twig = $app->view->getEnvironment();
$twig->addGlobal('lang',$lang);