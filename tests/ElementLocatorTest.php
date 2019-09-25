<?php
/** @noinspection PhpDocSignatureInspection */

namespace webignition\DomElementLocator\Tests;

use webignition\DomElementLocator\ElementLocator;

class ElementLocatorTest extends \PHPUnit\Framework\TestCase
{
    public function testGetLocator()
    {
        $locator = '.selector';

        $this->assertSame($locator, (new ElementLocator($locator))->getLocator());
    }

    public function testGetOrdinalPosition()
    {
        $elementLocatorWithoutOrdinalPosition = new ElementLocator('.selector');
        $elementLocatorWithOrdinalPosition = new ElementLocator('.selector', 1);

        $this->assertNull($elementLocatorWithoutOrdinalPosition->getOrdinalPosition());
        $this->assertSame(1, $elementLocatorWithOrdinalPosition->getOrdinalPosition());
    }

    public function testIsCssSelector()
    {
        $this->assertTrue((new ElementLocator('.selector'))->isCssSelector());
        $this->assertFalse((new ElementLocator('//h1'))->isCssSelector());
        $this->assertFalse((new ElementLocator(''))->isCssSelector());
    }

    public function testIsXpathExpression()
    {
        $this->assertFalse((new ElementLocator('.selector'))->isXpathExpression());
        $this->assertTrue((new ElementLocator('//h1'))->isXpathExpression());
        $this->assertFalse((new ElementLocator(''))->isXpathExpression());
    }
}
