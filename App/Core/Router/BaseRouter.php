<?php

namespace App\Core;

class BaseRouter
{
    /**
     * Self instantiation.
     *
     * @var $instance null
     */
    private static $instance = null;

    /**
     * Array list for URL with Request method type.
     *
     * @var array
     */
    protected static $routes = [];

    /**
     * Get the instance of itself if not null.
     *
     * @return static self
     */
    protected static function singleton()
    {
        if( is_null(self::$instance) ) {

            self::$instance = self::factory();
        }

        return self::$instance;
    }

    /**
     * Create and return static self.
     *
     * @return BaseRouter
     */
    protected static function factory()
    {

        return new self;
    }

    /**
     * Search for static method.
     *
     * @param string $name - Method name.
     * @param array $arguments - Method arguments.
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments = [])
    {

        if ( !method_exists(self::singleton(), $name) ) {

            throw new \Exception(
                " Method with name '{$name}',
                 do not exist. Check routes/web.php file."
            );
        }

        return call_user_func_array([self::singleton(), $name], ...$arguments);
    }

    /**
     * Add GET Request type Controller.
     *
     * @param string $uri
     * @param string $controller
     * @param array $parameters
     */
    public static function get($uri, $controller, $parameters = [])
    {
        self::$routes['QUERY'][$controller] = $parameters;

        self::$routes['GET'][$uri] = $controller;
    }

    /**
     * Add POST Request type Controller.
     *
     * @param string $uri
     * @param string $controller
     * @param array $parameters
     */
    public static function post($uri, $controller, $parameters = [])
    {
        self::$routes['QUERY'][$controller] = $parameters;

        self::$routes['POST'][$uri] = $controller;
    }

    /**
     * Load Route declaration file.
     *
     */
    public static function loadRoutes()
    {

        requirePath('routes/web');
    }

    /**
     * Return a route list.
     *
     * @return array
     */
    public static function returnRoutes()
    {

        self::loadRoutes();

        return self::$routes;
    }
}