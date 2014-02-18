<?php
namespace Lib;

/**
 * The Autoloader loading classes for this project.
 * 
 * @category Lib
 * @package Autoloader
 *
 * @author Rebel L <dj@rebel-l.net>
 * @copyright Lars Gaubisch 2014
 */
class Autoloader
{
	/**
	 * Root path to the project.
	 *
	 * @var string
	 */
	private $rootPath;

	/**
	 * Constructor initializing the root path.
	 *
	 * @param string $rootPath[optional] The path to projects root directory.
	 * @return Autoloader
	 */
	public function __construct($rootPath = null)
	{
		if(null === $rootPath){
			$rootPath = $this->detectRootPath();
		}
		$this->setRootPath($rootPath);
	}

    /**
     * Registers the autoloader.
     *
     * @return Autoloader
     */
    public function register()
    {
        spl_autoload_register([$this, 'loadClass']);
        return $this;
    }

    /**
     * Unregisters the autoloader.
     *
     * @return Autoloader
     */
    public function unregister()
    {
        spl_autoload_unregister([$this, 'loadClass']);
        return $this;
    }

    /**
     * Loads the required class.
     *
     * @param string $classname The class name to load
     * @return void
     */
    public function loadClass($classname)
    {
		$file = str_replace('\\', '/', $classname) . '.php';
		require_once($this->getRootPath() . $file);
    }

	/**
	 * Returns the path to projects root.
	 *
	 * @return string
	 */
	public function getRootPath()
	{
		return $this->rootPath;
	}

	/**
	 * Sets the projects root path.
	 *
	 * @param string $rootPath PAth to projects root.
	 * @return Autoloader
	 */
	public function setRootPath($rootPath)
	{
		$this->rootPath = $rootPath;
		return $this;
	}

	/**
	 * Detects and returns the project root directory.
	 *
	 * @return string
	 */
	private function detectRootPath()
	{
		$rootPath = dirname(__FILE__);
		$rootPath = realpath($rootPath . '/../' ) . '/';
		return $rootPath;
	}
} 