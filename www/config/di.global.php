<?php
use Controllers\PagesController;
use Controllers\UsersController;
use Core\DbConnectinterface;
use Models\Users;
use Core\Dbconnect;
use Repository\Userrepository;
use ValueObject\Dbname;
use ValueObject\Dbpassword;
use ValueObject\Dbuser;
use ValueObject\Dbdriver;
use ValueObject\Dbhost;

return [
    Dbconnectinterface::class => function ($container) {
        $host = $container['config']['database']['host'];
        $driver = $container['config']['database']['driver'];
        $name = $container['config']['database']['name'];
        $user = $container['config']['database']['user'];
        $password = $container['config']['database']['password'];

        return new Dbconnect(new Dbdriver($driver), new Dbhost($host), new Dbname($name), new Dbuser($user), new Dbpassword($password));
    },
    UsersController::class => function ($container) {
        $userModel = $container[Userrepository::class]($container);
        return new UsersController($userModel);
    },
    PagesController::class => function ($container) {
        return new PagesController();
    },
    Userrepository::class => function ($container) {
        $Dbconnect = $container [DbConnectinterface::class]($container);
        return new Userrepository($Dbconnect);
    }
];
