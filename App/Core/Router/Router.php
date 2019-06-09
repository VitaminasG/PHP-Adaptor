<?php

namespace App\Core;

use App\wildCard;

class Router
{
    use wildCard;

    /**
     * Array list for URL with Request method type.
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Controller namespace.
     *
     * @var string
     */
    protected $controller = null;

    /**
     * Controller method name.
     *
     * @var string
     */
    protected $action = null;

    /**
     * Controller's method parameters.
     *
     * @var array
     */
    protected $query = [];

    /**
     * The instance of Router.

     * @param BaseRouter $routes
     */
    public function __construct(BaseRouter $routes)
    {

        $this->routes = $routes::returnRoutes();
    }

    /**
     * Direct to requested Controller.
     *
     * @param $uri
     * @param $methodType
     * @return mixed
     */
    public function direct($uri, $methodType)
    {
        // Scan the Router List for WildCards.
        $this->createWL( $this->routes[$methodType] );

        // Get The WildCard List.
        $WildCardList = $this->getWL();

        // Push WC List to Router WC List.
        $this->setWildCard($WildCardList);

        // Push new URL list without WC.
        $this->routes[$methodType] = $this->getNL();

        // Search normal URL list.
        if ( array_key_exists($uri, $this->routes[$methodType]) ){

            $this->divider( $this->routes[$methodType][$uri] );

            return $this->callAction(

                $this->getController(),
                $this->getAction(),
                $this->getQuery()
            );
        // Search in WC List.
        } elseif ( $this->matchBoth($uri) ) {

            $call = $this->targetWC[$this->getUriKey()];
            $this->routes['QUERY'][$call] = ['name' => $this->getUriKey()];
            $this->divider($call);

            return $this->callAction(

                $this->getController(),
                $this->getAction(),
                $this->getQuery()
            );

        } else {

            // Failed in both List's
            return $this->notFound();
        }

    }

    /**
     * Assign and split string.
     *
     * @param string $string
     */
    protected function divider(string $string)
    {

        $this->setQuery($string);

        list($left, $right) = explode('@', $string);

        $this->setController($left);
        $this->setAction($right);
    }

    /**
     * Set a Controller namespace.
     *
     * @param string $controllerName
     */
    protected function setController(string $controllerName)
    {

        $controllerPath = sprintf('\App\%s', $controllerName);

        $this->controller = $controllerPath;
    }

    /**
     * Get a Controller namespace.
     *
     * @return string
     */
    protected function getController()
    {

        return $this->controller;
    }

    /**
     * Set a Controller method name.
     *
     * @param string $actionName
     */
    protected function setAction(string $actionName)
    {

        $this->action = $actionName;
    }

    /**
     * Get a Controller method name.
     *
     * @return string
     */
    protected function getAction(): string
    {

        return $this->action;
    }

    /**
     * Get a Controller method parameters.
     *
     * @return array
     */
    public function getQuery(): array
    {

        return $this->query;
    }

    /**
     * Set a Controller method parameters
     *
     * @param string $string
     */
    public function setQuery(string $string)
    {

        $this->query = $this->routes['QUERY'][$string];
    }

    /**
     * @param array $wildCard
     */
    public function setWildCard(array $wildCard)
    {
        $this->routes['WILDCARDS'] = $wildCard;
    }

    /**
     * Execute an action on the controller.
     *
     * @param       $controller
     * @param array $action
     * @param array $parameters
     *
     * @return mixed
     */
    public function callAction($controller, $action = [], $parameters = [])
    {

        $obj = new $controller;

        return call_user_func_array( [$obj, $action], $parameters );
    }

    /**
     * Serve 404 view.
     *
     * @return mixed
     */
    public function notFound(){

        $controller = new \App\Core\Controller();

        return $this->callAction( $controller, 'notFound' );
    }
}