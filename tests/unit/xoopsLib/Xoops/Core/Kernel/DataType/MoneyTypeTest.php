<?php
namespace Xoops\Core\Kernel\DataType;

require_once __DIR__ . '/../../../../../init_new.php';

use Xoops\Core\Kernel\DataType;
use Xoops\Core\Kernel\Format;
use Xoops\Core\Kernel\XoopsObject;
use Money\Money;
use Money\Currency;

/**
 * Test XoopsObject with a DataType::MONEY var
 */
class MoneyTypeObject extends XoopsObject
{
    public function __construct()
    {
        $this->initVar('money_test', DataType::MONEY);
    }
}

class MoneyTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var MoneyType
     */
    protected $object;

    /**
     * @var MoneyTypeObject
     */
    protected $xObject;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new MoneyType();
        $this->xObject = new MoneyTypeObject();
    }

    public function testContracts()
    {
        $this->assertInstanceOf('\Xoops\Core\Kernel\DataType\AbstractType', $this->object);
        $this->assertInstanceOf('\Xoops\Core\Kernel\DataType\MoneyType', $this->object);
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
        $testValue = new Money(10000, new Currency('USD'));
        $key = 'money_test';
        $this->xObject[$key] = $testValue;
        $this->xObject[$key] = $this->object->cleanVar($this->xObject, $key);

        $value = $this->xObject->getVar($key, Format::NONE);
        $this->assertInstanceOf('\Money\Money', $value);
        $this->assertEquals($testValue->getAmount(), $value->getAmount());
        $this->assertTrue($testValue->getCurrency()->equals($value->getCurrency()));
        $this->assertNotSame($value, $testValue);

        $value2 = $this->xObject->getVar($key, Format::SHOW);
        $this->assertInstanceOf('\Money\Money', $value2);
        $this->assertEquals($testValue->getAmount(), $value2->getAmount());
        $this->assertTrue($testValue->getCurrency()->equals($value2->getCurrency()));
        $this->assertNotSame($value, $value2);
    }

    public function testStoredRepresentation()
    {
        $testValue = new Money(30000, new Currency('EUR'));
        $key = 'money_test';
        $this->xObject[$key] = $testValue;
        $this->xObject->cleanVars();
        $value = $this->xObject->cleanVars[$key];
        $this->assertTrue(is_string($value));
        $decode = json_decode($value, true, 2, JSON_BIGINT_AS_STRING);
        $this->assertTrue(is_array($decode));
        $this->assertSame((string) $decode['amount'], '30000');
        $this->assertSame($decode['currency'], 'EUR');
    }
}
