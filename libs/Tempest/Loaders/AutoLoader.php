<?php

/**
 * Description of AutoLoader
 * autoload classes from Tempest
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\Loaders
 */

namespace Tempest\Loaders;

class AutoLoader extends \Tempest\Object {

    /**
     * aviable autoload pathes forautoloading
     * @var array
     */
    private $pathes;

    /** @var Tempest\Loaders\Autoloader */
    private static $instance = NULL;

    /**
     * add directory for autoload - fluent
     * @param string $path
     * @return \Tempest\Loaders\AutoLoader
     */
    public function addDirs(array $pathes = array()) {
        $this->pathes = $pathes;
        return $this;
    }

    /**
     * Returns singleton instance with lazy instantiation.
     * @return Tempest\Loaders\Autoloader
     */
    public static function getInstance() {
        if (self::$instance === NULL) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Register autoloader.
     * @return void
     */
    public function register() {
        if (!function_exists('spl_autoload_register')) {
            throw new NotSupportedException('spl_autoload does not exist in this PHP installation.');
        }

        spl_autoload_register(array($this, 'load'));
        return $this;
    }

    /**
     * autoloader
     * @param string $className
     */
    function load($className) {

        $className = ltrim($className, '\\');
        $fileName = '';
        $namespace = '';
        if ($lastNsPos = strripos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        // load from user defined folders
        if (!empty($this->pathes))
            foreach ($this->pathes as $key => $path) {
                if (is_readable($path . DIRECTORY_SEPARATOR . $fileName))
                    require $path . DIRECTORY_SEPARATOR . $fileName;
            }
    }

}
