<?php
namespace Xoops\Core\Kernel\DataType;

require_once __DIR__ . '/../../../../../init_new.php';

use Xoops\Core\Kernel\DataType;
use Xoops\Core\Kernel\Format;
use Xoops\Core\Kernel\XoopsObject;

/**
 * Test XoopsObject with a DataType::JSON var
 */
class JsonTypeObject extends XoopsObject
{
    public function __construct()
    {
        $this->initVar('jsontest', DataType::JSON);
    }
}

class JsonTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var JsonType
     */
    protected $object;

    /**
     * @var JsonTypeObject
     */
    protected $xObject;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new JsonType;
        $this->xObject = new JsonTypeObject();
    }

    public function testContracts()
    {
        $this->assertInstanceOf('\Xoops\Core\Kernel\DataType\AbstractType', $this->object);
        $this->assertInstanceOf('\Xoops\Core\Kernel\DataType\JsonType', $this->object);
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
        $testArray = ['dog' => 'Spot', 'girl' => 'Jane', 'Boy' => 'Dick', 'see' => 'run'];
        $key = 'jsontest';

        $this->xObject[$key] = $testArray;
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        //var_dump($this->xObject->vars[$key]['value']);
        $value = $this->xObject[$key];
        $this->assertTrue(is_array($value));
        $this->assertEquals('Spot', $value['dog']);
        $this->assertEquals('run', $value['see']);

        $value = $this->xObject->getVar($key, Format::SHOW);
        $this->assertTrue(is_array($value));

        $value = $this->xObject->getVar($key, Format::NONE);
        $this->assertTrue(is_string($value));
        $value = json_decode($value);
        $this->assertInstanceOf('\stdClass', $value);
        $this->assertEquals('Spot', $value->dog);
        $this->assertEquals('run', $value->see);

        unset($this->xObject[$key]);
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        $value = $this->xObject[$key];
        $this->assertNull($value);

        $this->xObject[$key] = 'string';
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        $value = $this->xObject[$key];
        $this->assertEquals('string', $value);

        $this->xObject[$key] = json_decode(json_encode($testArray));
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        $value = $this->xObject[$key];
        $this->assertTrue(is_array($value));
        $this->assertEquals('Spot', $value['dog']);
        $this->assertEquals('run', $value['see']);

        $value = json_encode($testArray);
        $this->xObject[$key] = $value;
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        $actualValue = $this->xObject->getVar($key, Format::NONE);
        $this->assertSame($value, $actualValue);
    }
}
