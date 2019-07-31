<?php
namespace Xoops\Core\Kernel\DataType;

require_once __DIR__ . '/../../../../../init_new.php';

use Xoops\Core\Kernel\DataType;
use Xoops\Core\Kernel\Format;
use Xoops\Core\Kernel\XoopsObject;

/**
 * Test XoopsObject with a DataType::SHORT_TIME, TYPE_MEDIUM_TIME and TYPE_LONG_TIME vars
 */
class SimpleTimeTypeObject extends XoopsObject
{
    public function __construct()
    {
        $this->initVar('stime_test', DataType::SHORT_TIME);
        $this->initVar('mtime_test', DataType::MEDIUM_TIME);
        $this->initVar('ltime_test', DataType::LONG_TIME);
    }
}

class SimpleTimeTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var SimpleTimeType
     */
    protected $object;

    /**
     * @var SimpleTimeTypeObject
     */
    protected $xObject;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new SimpleTimeType();
        $this->xObject = new SimpleTimeTypeObject();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testContracts()
    {
        $this->assertInstanceOf('\Xoops\Core\Kernel\DataType\AbstractType', $this->object);
        $this->assertInstanceOf('\Xoops\Core\Kernel\DataType\SimpleTimeType', $this->object);
    }

    /**
     * @dataProvider provider
     */
    public function testCleanVar($objectKey)
    {
        $testValue = time();

        $key = $objectKey;
        $this->xObject[$key] = $testValue;
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        $value = $this->xObject->getVar($key, Format::NONE);
        $this->assertEquals($testValue, $value);

        $this->xObject[$key] = date(DATE_RFC850, $testValue);
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        $value = $this->xObject->getVar($key, Format::NONE);
        $this->assertEquals($testValue, $value);
    }

    public function provider()
    {
        return [
            ['stime_test'],
            ['mtime_test'],
            ['ltime_test'],
        ];
    }
}
