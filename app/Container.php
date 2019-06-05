<?php

namespace App;

use Exception;

class Container
{

    /**
     * Main config file.
     *
     * @var array
     */
    private $config;

    /**
     * Request uri.
     *
     * @var
     */
    private $url;

    /**
     * Request method.
     *
     * @var
     */
    private $method;

    /**
     * The instance of Dependency Injection.
     *
     * @throws Exception
     */
    public function __construct()
    {

        $this->config = $this->defaultConf();
    }

    /**
     * Get default configuration file.
     *
     * @return array
     *
     * @throws Exception
     */
    private function defaultConf()
    {

        if( !file_exists(filePath('config')) ) {

            throw new Exception('Can not find config file!');
        }

        return requirePath('config');
    }


    /**
     * Direct traffic to dedicated router.
     *
     */
    public function direct()
    {
        $router = new \App\Core\Router( new \App\Core\BaseRouter() );

        $router->direct($this->getUrl(), $this->getMethod());
    }

    /**
     * Get Request uri.
     *
     * @return string
     */
    protected function getUrl()
    {

        $this->url = \App\Core\Request::uri();

        return $this->url;
    }

    /**
     * Get Request method.
     *
     * @return string
     */
    protected function getMethod()
    {

        $this->method = \App\Core\Request::method();

        return $this->method;
    }

    /**
     * Add new item to Container.
     *
     * @param $key
     * @param $value
     */
    public function add($key, $value)
    {

        $this->config[$key] = $value;
    }

    /**
     * Get the item from the Container.
     *
     * @param $key
     * @return mixed
     * @throws Exception
     */
    protected function get($key)
    {
        if(!array_key_exists($key, $this->config)){

            throw new Exception("The {$key} do not exist in the config file.");
        }

        return $this->config[$key];
    }

    /**
     * Get App name.
     *
     * @return string
     */
    public function appName()
    {

        $result = findElement($this->config, 'appName');

        return first($result) ?? 'Default name';
    }
}