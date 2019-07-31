<?php
require_once(__DIR__.'/../../../../init_new.php');

class FormatTest extends \PHPUnit\Framework\TestCase
{
    protected $myclass = 'Xoops\Core\Kernel\Format';

    public function testConstants()
    {
        $this->assertTrue(defined('Xoops\Core\Kernel\Format::SHOW'));
        $this->assertTrue(defined('Xoops\Core\Kernel\Format::EDIT'));
        $this->assertTrue(defined('Xoops\Core\Kernel\Format::PREVIEW'));
        $this->assertTrue(defined('Xoops\Core\Kernel\Format::FORM_PREVIEW'));
        $this->assertTrue(defined('Xoops\Core\Kernel\Format::NONE'));
    }
}
