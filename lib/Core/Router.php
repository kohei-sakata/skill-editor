<?php

namespace Amderbar\Lib\Core;

use Closure;

/**
 *
 * @author amderbar
 *
 */
class Router
{
    private static $router;

    private $path_prefix;
    private $get_routing = [];
    private $post_routing = [];

    public static function setup(Closure $setup_func, ?string $path_prefix = null) :self
    {
        self::$router = self::$router ?? new self($path_prefix);
        call_user_func($setup_func, self::$router);
        return self::$router;
    }

    /**
     *
     * @param string $path_prefix
     */
    private function __construct(?string $path_prefix = null)
    {
        $this->path_prefix = $path_prefix;
    }

    /**
     *
     * @param string $path
     * @param unknown $action
     */
    public function whenGet(string $path, $action) :void
    {
        $this->get_routing[$this->getPrefix() . $path] = $action;
    }

    /**
     *
     * @param string $path
     * @param unknown $action
     */
    public function whenPost(string $path, $action) :void
    {
        $this->post_routing[$this->getPrefix() . $path] = $action;
    }

    /**
     *
     * @param string $path
     * @param unknown $action
     */
    public function whenAny(string $path, $action) :void
    {
        $this->get_routing[$this->getPrefix() . $path] = $action;
        $this->post_routing[$this->getPrefix() . $path] = $action;
    }

    /**
     *
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->path_prefix ?? '';
    }

    /**
     *
     * @param string $path
     * @param string $method
     * @return array
     */
    public function getAction(string $path, string $method):array
    {
        $routing_arr = ($method === 'GET') ? $this->get_routing
                        : (($method === 'POST') ? $this->post_routing : []);
        return $this->searchAction($path, $routing_arr);
    }

    /**
     *
     * @param string $path
     * @param array $routing
     * @return array
     */
    private function searchAction (string $path, array $routing):array
    {
        foreach ($routing as $key => $action) {
            preg_match_all(';\{([^/]+)\};', $key, $keys, PREG_SET_ORDER);
            $regex = preg_replace('/\\\{[^\/]+\\\}/', '([^\/]+)', preg_quote($key, '/'));
            if (preg_match("/\A{$regex}\/?\Z/", $path, $params)) {
                unset($params[0]);
                return [$action, array_combine(array_column($keys, 1), $params)];
            }
        }
        return [null, []];
    }
}
