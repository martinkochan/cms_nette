<?php

namespace App;

use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

/**
 * Route factory. Manages routing in application.
 * @package App
 */
class RouterFactory
{

    /**
     * @return RouteList final application router
     */
    public static function createRouter()
    {
        $router = new RouteList();
        $router[] = new Route('kontakt/', 'Core:Contact:default');
        $router[] = new Route('<action>/', array(
            'presenter' => 'Core:Administration',
            'action' => array(
                Route::FILTER_TABLE => array(
                    'administrace' => 'default',
                    'prihlaseni' => 'login',
                    'odhlasit' => 'logout',
                    'registrace' => 'register'
                ),
                Route::FILTER_STRICT => true
            )
        ));
        
        $router[] = new Route('[<action>/][<url>]', array(
            'presenter' => 'Core:Article',
            'action' => array(
                Route::VALUE => 'default',
                Route::FILTER_TABLE => array(
                    'seznam-clanku' => 'list',
                    'editor' => 'editor',
                    'odstranit' => 'remove'
                ),
                Route::FILTER_STRICT => true
             ),
            'url' => null,
        ));
        $router[] = new Route('[<url>]', 'Core:Article:default');
        return $router;
    }

}
