<?php

namespace App\Core;

class Router
{

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

        if ( !array_key_exists($uri, $this->routes[$methodType]) ){

            return $this->notFound();
        }

        $this->divider($this->routes[$methodType][$uri]);

        return $this->callAction(

            $this->getController(),
            $this->getAction()

        );
    }

    /**
     * Split and assign string.
     *
     * @param string $string
     */
    protected function divider(string $string)
    {

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
    protected function getAction()
    {

        return $this->action;
    }

    /**
     * Execute an action on the controller.
     *
     * @param $controller
     * @param array $action
     * @return mixed
     */
    public function callAction($controller, $action = [])
    {

        $obj = new $controller;

        return call_user_func_array([$obj, $action], [ $parameters = [] ] );
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