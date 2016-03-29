<?php
define("ROOT", dirname(__FILE__));
ini_set('error_reporting', E_ALL);
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\Model\Manager as ModelsManager;
try {

    // Register an autoloader
    $loader = new Loader();
    $loader->registerDirs(array(
        '../app/controllers/',
        '../app/models/',
        '../app/library'
    ))->register();

    // Create a DI
    $di = new FactoryDefault();
    $di->set('modelsManager', function() {
        return new ModelsManager();
    });
    //session
    $di->setShared('session', function() {
        $session = new Phalcon\Session\Adapter\Files();
        $session->start();
        return $session;
    });
    // Setup the view component
    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        $view->registerEngines(array(
            ".phtml" => 'Phalcon\Mvc\View\Engine\Volt'
        ));

        return $view;
    });
    $di->set('db', function() {
        return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => "localhost",
            "username" => "root",
            "password" => "123456",
            "dbname" => "gamesns",
            "charset"=>"utf8"
        ));
    });
    // Setup a base URI so that all generated URIs include the "tutorial" folder
    $di->set('url', function () {
        $url = new UrlProvider();
        $url->setBaseUri('/');
        return $url;
    });

    // Handle the request
    $application = new Application($di);
    echo $application->handle()->getContent();
} catch (\Exception $e) {
    echo "Exception: ", $e->getMessage();
}