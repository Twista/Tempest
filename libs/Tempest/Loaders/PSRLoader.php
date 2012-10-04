<?php

/**
 * Description of PSRLoader
 * autoload classes from Tempest
 *
 * @author Michal Haták [Twista] <me@twista.cz>
 * @package Tempest
 * @category Tempest\Loaders
 */

namespace Tempest\Loaders;

class PSRLoader extends \Tempest\Object {

    /** @var Tempest\Loaders\PSRloader */
    private static $instance = NULL;

    /**
     * Returns singleton instance with lazy instantiation.
     * @return Tempest\Loaders\PSRloader
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

        // psr standartized
        if (is_readable(LIB_DIR . DIRECTORY_SEPARATOR . $fileName))
            require LIB_DIR . DIRECTORY_SEPARATOR . $fileName;
    }

}
