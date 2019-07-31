<?php
namespace Xoops\Core\Kernel\DataType;

require_once __DIR__ . '/../../../../../init_new.php';

use Xoops\Core\Kernel\DataType;
use Xoops\Core\Kernel\Format;
use Xoops\Core\Kernel\XoopsObject;

/**
 * Test XoopsObject with a DataType::TIMEZONE var
 */
class TimeZoneTypeObject extends XoopsObject
{
    public function __construct()
    {
        $this->initVar('timezone_test', DataType::TIMEZONE);
    }
}

class TimeZoneTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var TimeZoneType
     */
    protected $object;

    /**
     * @var TimeZoneTypeObject
     */
    protected $xObject;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new TimeZoneType();
        $this->xObject = new TimeZoneTypeObject();
    }

    public function testContracts()
    {
        $this->assertInstanceOf('\Xoops\Core\Kernel\DataType\AbstractType', $this->object);
        $this->assertInstanceOf('\Xoops\Core\Kernel\DataType\TimeZoneType', $this->object);
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
        $testValue = 'America/New_York';
        $key = 'timezone_test';

        $this->xObject[$key] = $testValue;
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        $value = $this->xObject->getVar($key, Format::NONE);
        $this->assertEquals($testValue, $value);

        $value1 = $this->xObject->getVar($key, Format::SHOW);
        $this->assertInstanceOf('\DateTimeZone', $value1);
        $this->assertEquals($testValue, $value1->getName());
        $value2 = $this->xObject[$key];
        $this->assertInstanceOf('\DateTimeZone', $value2);
        $this->assertEquals($testValue, $value2->getName());
        $this->assertNotSame($value1, $value2);


        $this->xObject[$key] = new \DateTimeZone($testValue);
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        $value = $this->xObject->getVar($key, Format::NONE);
        $this->assertEquals($testValue, $value);

        $this->xObject[$key] = new \DateTime('now', new \DateTimeZone($testValue));
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        $value = $this->xObject->getVar($key, Format::NONE);
        $this->assertEquals($testValue, $value);
    }

    public function testGetVarCleanVar_error()
    {
        $testValue = 'GarbageTimeZone';
        $key = 'timezone_test';

        $this->xObject[$key] = $testValue;
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        $value = $this->xObject->getVar($key, Format::NONE);
        $this->assertEquals('UTC', $value);

        $value1 = $this->xObject->getVar($key, Format::SHOW);
        $this->assertInstanceOf('\DateTimeZone', $value1);
        $this->assertEquals('UTC', $value1->getName());
    }
}
