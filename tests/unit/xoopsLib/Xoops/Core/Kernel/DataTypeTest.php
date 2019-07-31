<?php
require_once(__DIR__.'/../../../../init_new.php');

class DataTypeTest extends \PHPUnit\Framework\TestCase
{
    protected $myclass = 'Xoops\Core\Kernel\DataType';

    public function test___construct()
	{
        $criteria = new $this->myclass();
        $this->assertInstanceOf($this->myclass, $criteria);
    }

    public function testConstants()
    {
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::ARRAY'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::DATETIME'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::DECIMAL'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::EMAIL'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::ENUM'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::FLOAT'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::INTEGER'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::JSON'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::MONEY'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::OTHER'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::SOURCE'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::TEXT'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::STRING'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::TIMEZONE'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::URL'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::SHORT_TIME'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::MEDIUM_TIME'));
        $this->assertTrue(defined('Xoops\Core\Kernel\DataType::LONG_TIME'));

        // is_subclass_of
        $obj = Xoops\Core\Kernel\DataType\AbstractType::class;

        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::ARRAY, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::DATETIME, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::DECIMAL, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::EMAIL, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::ENUM, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::FLOAT, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::INTEGER, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::JSON, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::MONEY, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::OTHER, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::SOURCE, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::TEXT, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::STRING, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::TIMEZONE, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::URL, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::SHORT_TIME, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::MEDIUM_TIME, $obj, true));
        $this->assertTrue(is_subclass_of(Xoops\Core\Kernel\DataType::LONG_TIME, $obj, true));
    }

    public function test_cleanVar()
	{
		$this->markTestIncomplete();
    }

    public function test_getVar()
	{
		$this->markTestIncomplete();
    }
}
