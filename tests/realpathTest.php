<?php

use function \Leo\realpath;
use \PHPUnit\Framework\TestCase;

/**
 * @testdox function \Leo\realpath
 */
class realpathTest extends TestCase
{
	public function testEmptyPath():void
	{
		$this->assertSame(getcwd(), realpath(''));
	}

	public function testRelativePath():void
	{
		$this->assertSame(
			getcwd() . DIRECTORY_SEPARATOR . 'c.txt',
			realpath('a/b/../../c.txt')
		);
	}

	public function testAbsolutePath():void
	{
		$this->assertSame(
			'/path/to/else/myfile',
			realpath('/path/to/somewhere/./../else/myfile')
		);
	}
}

?>
