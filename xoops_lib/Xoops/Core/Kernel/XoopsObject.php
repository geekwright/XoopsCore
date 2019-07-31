<?php
/**
 * XOOPS Kernel Object
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace Xoops\Core\Kernel;

/**
 * Establish Xoops object datatype legacy defines
 * New code should use DataType::* constants
 *
 * These will eventually be removed. See Xoops\Core\Kernel\DataType for more.
 */
define('XOBJ_DTYPE_TXTBOX', DataType\StringType::class);
define('XOBJ_DTYPE_TXTAREA', DataType\TextType::class);
define('XOBJ_DTYPE_INT', DataType\IntegerType::class);
define('XOBJ_DTYPE_URL', DataType\UrlType::class);
define('XOBJ_DTYPE_EMAIL', DataType\EmailType::class);
define('XOBJ_DTYPE_ARRAY', DataType\ArrayType::class);
define('XOBJ_DTYPE_OTHER', DataType\OtherType::class);
define('XOBJ_DTYPE_SOURCE', DataType\SourceType::class);
define('XOBJ_DTYPE_STIME', DataType\SimpleTimeType::class);
define('XOBJ_DTYPE_MTIME', DataType\SimpleTimeType::class);
define('XOBJ_DTYPE_LTIME', DataType\SimpleTimeType::class);
define('XOBJ_DTYPE_FLOAT', DataType\FloatType::class);
define('XOBJ_DTYPE_DECIMAL', DataType\DecimalType::class);
define('XOBJ_DTYPE_ENUM', DataType\EnumerationType::class);


/**
 * Base class for all objects in the Xoops kernel (and beyond)
 *
 * @category  Xoops\Core\Kernel\XoopsObject
 * @package   Xoops\Core\Kernel
 * @author    Kazumi Ono (AKA onokazu) <http://www.myweb.ne.jp/, http://jp.xoops.org/>
 * @author    Taiwen Jiang <phppp@users.sourceforge.net>
 * @copyright 2000-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
abstract class XoopsObject implements \ArrayAccess
{
    /**
     * holds all variables(properties) of an object
     *
     * @var array
     */
    public $vars = [];

    /**
     * variables cleaned for store in DB
     *
     * @var array
     */
    public $cleanVars = [];

    /**
     * parameter types matching $cleanVars above
     *
     * @var array
     */
    public $cleanTypes = [];

    /**
     * is it a newly created object?
     *
     * @var bool
     */
    private $isNew = false;

    /**
     * has any of the values been modified?
     *
     * @var bool
     */
    private $isDirty = false;

    /**
     * errors
     *
     * @var array
     */
    private $errors = [];

    /**
     * @var string
     */
    public $plugin_path;

    /**
     * constructor
     *
     * normally, this is called from child classes only
     *
     * @access public
     */
    public function __construct()
    {
    }

    /**
     * used for new/clone objects
     *
     * @return void
     */
    public function setNew(): void
    {
        $this->isNew = true;
    }

    /**
     * clear new flag
     *
     * @return void
     */
    public function unsetNew(): void
    {
        $this->isNew = false;
    }

    /**
     * check new flag
     *
     * @return bool
     */
    public function isNew(): bool
    {
        return $this->isNew;
    }

    /**
     * mark modified objects as dirty
     *
     * used for modified objects only
     *
     * @return void
     */
    public function setDirty(): void
    {
        $this->isDirty = true;
    }

    /**
     * clear dirty flag
     *
     * @return void
     */
    public function unsetDirty(): void
    {
        $this->isDirty = false;
    }

    /**
     * check dirty flag
     *
     * @return bool
     */
    public function isDirty(): bool
    {
        return $this->isDirty;
    }

    /**
     * initialize variables for the object
     *
     * @param string $key       key
     * @param int    $data_type set to one of DataType::XXX constants (set to DataType::OTHER
     *                           if no data type checking nor text sanitizing is required)
     * @param mixed  $value     value
     * @param bool   $required  require html form input?
     * @param mixed  $maxlength for DataType::STRING type only
     * @param string $options   does this data have any select options?
     *
     * @return void
     */
    public function initVar($key, $data_type, $value = null, $required = false, $maxlength = null, $options = ''): void
    {
        $this->vars[$key] = [
            'value' => $value,
            'required' => $required,
            'data_type' => $data_type,
            'maxlength' => $maxlength,
            'changed' => false,
            'options' => $options
        ];
    }

    /**
     * assign a value to a variable
     *
     * @param string $key   name of the variable to assign
     * @param mixed  $value value to assign
     *
     * @return void
     */
    public function assignVar($key, $value): void
    {
        if (isset($key, $this->vars[$key])) {
            $this->vars[$key]['value'] = $value;
        }
    }

    /**
     * assign values to multiple variables in a batch
     *
     * @param array $var_arr associative array of values to assign
     *
     * @return void
     */
    public function assignVars($var_arr): void
    {
        if (is_array($var_arr)) {
            foreach ($var_arr as $key => $value) {
                $this->assignVar($key, $value);
            }
        }
    }

    /**
     * assign a value to a variable
     *
     * @param string $key     name of the variable to assign
     * @param mixed  $value   value to assign
     *
     * @return void
     */
    public function setVar($key, $value): void
    {
        if (!empty($key) && isset($value, $this->vars[$key])) {
            $this->vars[$key]['value'] = $value;
            $this->vars[$key]['changed'] = true;
            $this->setDirty();
        }
    }

    /**
     * assign values to multiple variables in a batch
     *
     * @param array $var_arr associative array of values to assign
     *
     * @return void
     */
    public function setVars($var_arr): void
    {
        if (is_array($var_arr)) {
            foreach ($var_arr as $key => $value) {
                $this->setVar($key, $value);
            }
        }
    }

    /**
     * unset variable(s) for the object
     *
     * @param string|string[] $var variable(s)
     *
     * @return bool
     */
    public function destroyVars($var): bool
    {
        if (empty($var)) {
            return true;
        }
        $var = !is_array($var) ? [$var] : $var;
        foreach ($var as $key) {
            if (!isset($this->vars[$key])) {
                continue;
            }
            $this->vars[$key]['changed'] = null;
        }
        return true;
    }

    /**
     * returns all variables for the object
     *
     * @return array associative array of key->value pairs
     */
    public function getVars(): array
    {
        return $this->vars;
    }

    /**
     * Returns the values of the specified variables
     *
     * @param mixed  $keys     An array containing the names of the keys to retrieve, or null to get all of them
     * @param string $format   Format::xxxx constant representing intended use (see getVar)
     * @param int    $maxDepth Maximum level of recursion to use if some vars are objects themselves
     *
     * @return array associative array of key->value pairs
     */
    public function getValues($keys = null, $format = Format::SHOW, $maxDepth = 1)
    {
        if (!isset($keys)) {
            $keys = array_keys($this->vars);
        }
        $vars = [];
        if (is_array($keys)) {
            foreach ($keys as $key) {
                if (isset($this->vars[$key])) {
                    if ($this->vars[$key] instanceof self) {
                        if ($maxDepth) {
                            /* @var $obj XoopsObject */
                            $obj = $this->vars[$key];
                            $vars[$key] = $obj->getValues(null, $format, $maxDepth - 1);
                        }
                    } else {
                        $vars[$key] = $this->getVar($key, $format);
                    }
                }
            }
        }
        return $vars;
    }

    /**
     * returns a specific variable for the object in a proper format
     *
     * @param string $key    key of the object's variable to be returned
     * @param string $format format to use for the output
     *
     * @return mixed formatted value of the variable
     */
    public function getVar($key, $format = Format::SHOW)
    {
        $ret = null;
        if (!isset($this->vars[$key])) {
            return $ret;
        }
        $ret = DataType::getVar($this, $key, $format);
        return $ret;
    }

    /**
     * clean values of all variables of the object for storage.
     *
     * @return bool true if successful
     */
    public function cleanVars(): bool
    {
        $existing_errors = $this->getErrors();
        $this->errors = [];
        foreach ($this->vars as $k => $v) {
            if ($v['changed']) {
                $this->cleanVars[$k] = DataType::cleanVar($this, $k);
            }
        }
        $this->cleanTypes = [];
        foreach ($this->cleanVars as $k => $v) {
            $this->cleanTypes[] = DataType::getBindingType($this, $k);
        }
        if (count($this->errors) > 0) {
            $this->errors = array_merge($existing_errors, $this->errors);
            return false;
        }
        // $this->_errors = array_merge($existing_errors, $this->_errors);
        $this->unsetDirty();
        return true;
    }

    /**
     * create a clone(copy) of the current object
     *
     * @return object clone
     */
    public function xoopsClone()
    {
        return clone $this;
    }

    /**
     * Adjust a newly cloned object
     */
    public function __clone()
    {
        // need this to notify the handler class that this is a newly created object
        $this->setNew();
    }

    /**
     * add an error
     *
     * @param string $err_str to add
     *
     * @return void
     */
    public function setErrors($err_str): void
    {
        if (is_array($err_str)) {
            $this->errors = array_merge($this->errors, $err_str);
        } else {
            $this->errors[] = trim($err_str);
        }
    }

    /**
     * return the errors for this object as an array
     *
     * @return array an array of errors
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * return the errors for this object as html
     *
     * @return string html listing the errors
     * @todo remove hardcoded HTML strings
     */
    public function getHtmlErrors(): string
    {
        $ret = '<h4>Errors</h4>';
        if (!empty($this->errors)) {
            foreach ($this->errors as $error) {
                $ret .= $error . '<br />';
            }
        } else {
            $ret .= 'None<br />';
        }
        return $ret;
    }

    /**
     * Get object variables as an array
     *
     * @return array of object values
     */
    public function toArray()
    {
        return $this->getValues();
    }

    /**
     * ArrayAccess methods
     */

    /**
     * offsetExists
     *
     * @param mixed $offset array key
     *
     * @return bool true if offset exists
     */
    public function offsetExists($offset)
    {
        return isset($this->vars[$offset]);
    }

    /**
     * offsetGet
     *
     * @param mixed $offset array key
     *
     * @return mixed value
     */
    public function offsetGet($offset)
    {
        return $this->getVar($offset);
    }

    /**
     * offsetSet
     *
     * @param mixed $offset array key
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->setVar($offset, $value);
    }

    /**
     * offsetUnset
     *
     * @param mixed $offset array key
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        $this->vars[$offset]['value'] = null;
        $this->vars[$offset]['changed'] = true;
        $this->setDirty();
    }
}
