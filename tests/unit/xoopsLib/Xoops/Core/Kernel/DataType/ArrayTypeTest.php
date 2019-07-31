<?php
namespace Xoops\Core\Kernel\DataType;

require_once __DIR__ . '/../../../../../init_new.php';

use Xoops\Core\Kernel\DataType;
use Xoops\Core\Kernel\Format;
use Xoops\Core\Kernel\XoopsObject;

/**
 * Test XoopsObject with a DataType::ARRAY var
 */
class ArrayTypeObject extends XoopsObject
{
    public function __construct()
    {
        $this->initVar('arraytest', DataType::ARRAY);
    }
}

class ArrayTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ArrayType
     */
    protected $object;

    /**
     * @var ArrayTypeObject
     */
    protected $xObject;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ArrayType;
        $this->xObject = new ArrayTypeObject();
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
        $this->assertInstanceOf('\Xoops\Core\Kernel\DataType\ArrayType', $this->object);
    }

    public function testGetVarCleanVar()
    {
        $testArray = [
            'dog' => 'Spot',
            'girl' => 'Jane',
            'Boy' => 'Dick',
            'see' => 'run',
            "I'm a problem" => 'Not "really.',
        ];
        $key = 'arraytest';

        $this->xObject[$key] = $testArray;
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);
        //var_dump($this->xObject->vars[$key]['value']);
        $value = $this->xObject[$key];
        $this->assertTrue(is_array($value));
        $this->assertEquals('Spot', $value['dog']);
        $this->assertEquals('run', $value['see']);

        $value = $this->xObject->getVar($key, Format::SHOW);
        $this->assertTrue(is_array($value));
        //var_dump($value);

        $value = $this->xObject->getVar($key, Format::NONE);
        $this->assertTrue(is_string($value));
        //var_dump($value);
        $this->assertEquals("a:5:{s:", substr($value, 0, 7));
    }
}
