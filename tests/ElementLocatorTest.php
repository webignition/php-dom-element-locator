<?php

namespace webignition\DomElementLocator\Tests;

use webignition\DomElementLocator\ElementLocator;
use webignition\DomElementLocator\ElementLocatorInterface;

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

    /**
     * @dataProvider toStringDataProvider
     */
    public function testToString(ElementLocatorInterface $locator, string $expectedString)
    {
        $this->assertSame($expectedString, (string) $locator);
    }

    public function toStringDataProvider(): array
    {
        return [
            'empty' => [
                'locator' => new ElementLocator(''),
                'expectedString' => '""',
            ],
            'css selector' => [
                'locator' => new ElementLocator('.selector'),
                'expectedString' => '".selector"',
            ],
            'css selector containing double quotes' => [
                'locator' => new ElementLocator('a[href="https://example.org"]'),
                'expectedString' => '"a[href=\"https://example.org\"]"',
            ],
            'xpath expression' => [
                'locator' => new ElementLocator('//body'),
                'expectedString' => '"//body"',
            ],
            'xpath expression containing double quotes' => [
                'locator' => new ElementLocator('//*[@id="id"]'),
                'expectedString' => '"//*[@id=\"id\"]"',
            ],
            'css selector with ordinal position' => [
                'locator' => new ElementLocator('.selector', 3),
                'expectedString' => '".selector":3',
            ],
        ];
    }

    public function testToStringDelimiterIsPublic()
    {
        $this->assertEquals(ElementLocator::DELIMITER, ElementLocator::DELIMITER);
    }
}
