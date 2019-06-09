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

    protected $query = [];

    protected $wildCard = [];

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

        $this->createList($this->routes[$methodType]);

        $this->setWildCard( $this->getUriList() );

        pp($this->routes);

        if ( !array_key_exists($uri, $this->routes[$methodType]) ){

            return $this->notFound();
        }

        $this->divider($this->routes[$methodType][$uri]);

        return $this->callAction(

            $this->getController(),
            $this->getAction(),
            $this->getQuery()
        );
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
     * @return array
     */
    public function getQuery(): array
    {

        return $this->query;
    }

    /**
     * @param string $string
     */
    public function setQuery(string $string)
    {

        $this->query = $this->routes['QUERY'][$string];
    }

    /**
     * @return array
     */
    public function getWildCard(): array
    {
        return $this->wildCard;
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

        return call_user_func_array([$obj, $action], $parameters );
    }

    /**
     * Serve 404 view.
     *
     * @return mixed
     */
    public function notFound(){

        $controller = new \App\Core\Controller();

        return $this->callAction($controller, 'notFound');
    }
}