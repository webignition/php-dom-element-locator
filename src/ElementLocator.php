<?php

namespace webignition\DomElementLocator;

class ElementLocator implements ElementLocatorInterface
{
    const XPATH_EXPRESSION_FIRST_CHARACTER = '/';

    private $locator;
    private $ordinalPosition;

    public function __construct(string $locator, ?int $ordinalPosition = null)
    {
        $this->locator = $locator;
        $this->ordinalPosition = $ordinalPosition;
    }

    public function getLocator(): string
    {
        return $this->locator;
    }

    public function getOrdinalPosition(): ?int
    {
        return $this->ordinalPosition;
    }

    public function isCssSelector(): bool
    {
        $isXpathExpression = $this->locatorFirstCharacterIsXpathExpressionFirstCharacter();
        if (null === $isXpathExpression) {
            return false;
        }

        return !$isXpathExpression;
    }

    public function isXpathExpression(): bool
    {
        return true === $this->locatorFirstCharacterIsXpathExpressionFirstCharacter();
    }

    private function locatorFirstCharacterIsXpathExpressionFirstCharacter(): ?bool
    {
        $locator = trim($this->locator);

        if ('' === $locator) {
            return null;
        }

        return self::XPATH_EXPRESSION_FIRST_CHARACTER === $locator[0];
    }
}
