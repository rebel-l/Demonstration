<?php
namespace tests\lib;
use Lib\Autoloader;
use tests\fixtures\lib\TestUnregister;

require_once(dirname(__FILE__) . '/../../lib/Autoloader.php');

/**
 * Test for Autoloader
 * 
 * @category Test
 * @package Lib
 *
 * @author Rebel L <dj@rebel-l.net>
 * @copyright Lars Gaubisch 2014
 */
class AutoloaderTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Test the mutators for the root path.
	 *
	 * @covers Lib\Autoloader::__construct
	 * @covers Lib\Autoloader::getRootPath
	 * @covers Lib\Autoloader::setRootPath
	 * @covers Lib\Autoloader::detectRootPath
	 */
	public function testMutatorsRootPath()
	{
		$fixture = 'myRootPath';
		$autoloader = new Autoloader();
		$this->assertSame($this->getDefaultRootPath(), $autoloader->getRootPath(), 'Default root path does not match');
		$this->assertInstanceOf('Lib\Autoloader', $autoloader->setRootPath($fixture), 'Fluent interface not working');
		$this->assertSame($fixture, $autoloader->getRootPath(), 'Setter or getter of root path not working correctly');
	}


	/**
	 * Test loadoing class manually.
	 *
	 * @covers Lib\Autoloader::loadClass
	 */
	public function testLoadClassManually()
	{
		$fixtures = '\tests\fixtures\lib\TestLoadManually';
		$autoloader = new Autoloader();
		$autoloader->loadClass($fixtures);
		$this->assertTrue(class_exists($fixtures));
	}

	/**
	 * Test registring and unregestring the autoloader.
	 *
	 * @depends testLoadClassManually
	 * @covers Lib\Autoloader::register
	 * @covers Lib\Autoloader::unregister
	 */
	public function testUnRegister()
	{
		$autoloader = new Autoloader();
		$this->assertInstanceOf('Lib\Autoloader', $autoloader->register(), 'Fluent interface not working');
		$this->assertTrue(class_exists('\tests\fixtures\lib\TestUnregister'));
		$this->assertInstanceOf('Lib\Autoloader', $autoloader->unregister(), 'Fluent interface not working');
	}

	/**
	 * Returns the root path.
	 *
	 * @return string
	 */
	private function getDefaultRootPath()
	{
		return dirname(dirname(dirname(__FILE__))) . '/';
	}
}
 