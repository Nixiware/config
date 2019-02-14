<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Nixiware\Config\EnvVar;

final class EnvVarTest extends TestCase
{
	public function testBoolean()
	{
		$this->assertTrue(
			EnvVar::get('BOOL_TRUE', true, null, EnvVar::TypeBool)
		);

		$this->assertFalse(
			EnvVar::get('BOOL_FALSE', true, null, EnvVar::TypeBool)
		);
	}

	public function testInt()
	{
		$this->assertEquals(
			1234, 
			EnvVar::get('INT', true, null, EnvVar::TypeInt)
		);

		$this->assertEquals(
			'1234', 
			EnvVar::get('INT', true, null, EnvVar::TypeString)
		);
	}

	public function testString()
	{
		$this->assertEquals(
			'abcd1234', 
			EnvVar::get('STRING', true, null, EnvVar::TypeString)
		);
	}

	public function testFile()
	{
		$this->assertEquals(
			'Hl0wPwKDPpl8', 
			EnvVar::get('PASSWORD', true, null, EnvVar::TypeString)
		);
	}
}