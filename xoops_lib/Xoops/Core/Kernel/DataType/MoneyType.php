<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace Xoops\Core\Kernel\DataType;

use Xoops\Core\Kernel\XoopsObject;
use Xoops\Core\Kernel\Format;
use Money\Money;
use Money\Currency;

/**
 * MoneyType
 *
 * @category  Xoops\Core\Kernel\DataType\MoneyType
 * @package   Xoops\Core\Kernel
 * @author    Richard Griffith <richard@geekwright.com>
 * @copyright 2015-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
class MoneyType extends AbstractType
{
    /**
     * getVar get variable prepared according to format
     *
     * Recommended database column is varchar(48) or larger
     *
     * @param XoopsObject $obj    object containing variable
     * @param string      $key    name of variable
     * @param string      $format Format::* constant indicating desired formatting
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function getVar(XoopsObject $obj, $key, $format)
    {
        $storedValue = $obj->vars[$key]['value'];
        $format .= ' ';
        switch (strtolower($format[0])) {
            case Format::NONE:
            case Format::SHOW:
            default:
                $value = $this->unserializeJson($storedValue);
                break;
        }
        return $value;
    }

    /**
     * cleanVar prepare variable for persistence
     *
     * @param XoopsObject $obj object containing variable
     * @param string      $key name of variable
     *
     * @return string|null
     */
    public function cleanVar(XoopsObject $obj, $key)
    {
        $value = $obj->vars[$key]['value'];
        return ($value instanceof Money) ? $this->serializeAsJson($value) : $value;
    }

    /**
     * Serialize Money data to JSON string
     *
     * @param Money $value Money object to serialize as json
     *
     * @return string json encoded data to un
     */
    private function serializeAsJson(Money $value): string
    {
        return json_encode($value);
    }

    /**
     * unserializeJson unserialize JSON string to Money
     *
     * @param string $value JSON serialized money data
     *
     * @return Money|null
     *
     * @throws \InvalidArgumentException
     */
    private function unserializeJson($value): ?Money
    {
        $decoded = json_decode($value, true, 2, JSON_BIGINT_AS_STRING);
        if (false === $decoded || !(isset($decoded['amount']) && isset($decoded['currency']))) {
            return null;
        }
        return new Money((int) $decoded['amount'], new Currency($decoded['currency']));
    }
}
