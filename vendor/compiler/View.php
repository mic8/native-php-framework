<?php

/**
 * @author Michael Reynald <michaelreynald78@gmail.com>
 * View renderer
 */

namespace Vendor\Compiler;

class View
{
    private $config;

    private $target = '';
    private $params = [];

    public function __construct($target = '', $params = [])
    {
        $this->config = include('config/view.php');

        $this->target = $target;
        $this->params = $params;
    }

    public function init()
    {
        ob_start();
        extract($this->params);

        include_once(VIEW_PATH . '/' . $this->config['header'] . '.' . $this->config['extension']);
        $path = VIEW_PATH . '/' . $this->target . '.' . $this->config['extension'];
        if(file_exists($path)) {
            include(VIEW_PATH . '/' . $this->target . '.' . $this->config['extension']);
        } else {
            throw new \Exception('Invalid view file: ' . $path);
        }
        include_once(VIEW_PATH . '/' . $this->config['footer'] . '.' . $this->config['extension']);

        return true;
    }
}