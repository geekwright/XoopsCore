<?php
namespace Xoops\Core\Kernel\DataType;

require_once __DIR__ . '/../../../../../init_new.php';

use Xoops\Core\Kernel\DataType;
use Xoops\Core\Kernel\Format;
use Xoops\Core\Kernel\XoopsObject;

/**
 * Test XoopsObject with a DataType::DATETIME var
 */
class DateTimeTypeObject extends XoopsObject
{
    public function __construct()
    {
        $this->initVar('datetime_test', DataType::DATETIME);
    }
}

class DateTimeTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var DateTimeType
     */
    protected $object;

    /**
     * @var DateTimeTypeObject
     */
    protected $xObject;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new DateTimeType();
        $this->xObject = new DateTimeTypeObject();
    }

    public function testContracts()
    {
        $this->assertInstanceOf('\Xoops\Core\Kernel\DataType\AbstractType', $this->object);
        $this->assertInstanceOf('\Xoops\Core\Kernel\DataType\DateTimeType', $this->object);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testGetVarCleanVar()
    {
        $testValue = time();
        $key = 'datetime_test';

        $this->xObject[$key] = $testValue;
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        $value = $this->xObject->getVar($key, Format::NONE);
        $this->assertEquals($testValue, $value);

        $value1 = $this->xObject->getVar($key, Format::SHOW);
        $this->assertInstanceOf('\DateTime', $value1);
        $this->assertEquals($testValue, $value1->getTimestamp());
        $value2 = $this->xObject[$key];
        $this->assertInstanceOf('\DateTime', $value2);
        $this->assertEquals($testValue, $value2->getTimestamp());
        $this->assertNotSame($value1, $value2);
    }
}
