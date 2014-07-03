<?php

/**
 * Test for the CallbackFilterIterator polyfill.
 */
class CallbackFilterIteratorTest extends PHPUnit_Framework_TestCase
{
	public function testPolyfill()
	{
		$class    = new ReflectionClass('CallbackFilterIterator');
		$filename = dirname(dirname(__FILE__)) .
			DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'CallbackFilterIterator.php';

		if (version_compare(PHP_VERSION, '5.4', '<')) {
			$this->assertEquals($filename, $class->getFileName());
		}
		else {
			$this->assertNotEquals($filename, $class->getFileName());
		}
	}

	public function testCallback()
	{
		$iterator = new ArrayIterator(
			array('Apple', 'Banana', 'Cherry')
		);

		$iterator = new CallbackFilterIterator(
			$iterator,
			array($this, 'filter')
		);

		$result = array();

		foreach ($iterator as $item) {
			$result[] = $item;
		}

		$this->assertEquals(
			array('Apple'),
			$result
		);
	}

	public function filter($string)
	{
		return strlen($string) < 6;
	}
}
