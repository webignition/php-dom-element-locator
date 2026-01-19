<?php

namespace webignition\DomElementLocator;

class ElementLocator implements \Stringable, ElementLocatorInterface
{
    public const DELIMITER = '"';
    private const XPATH_EXPRESSION_FIRST_CHARACTER = '/';
    private const DELIMITER_ESCAPE = '\\';
    private const POSITION_DELIMITER = ':';

    private string $locator;
    private ?int $ordinalPosition;

    public function __construct(string $locator, ?int $ordinalPosition = null)
    {
        $this->locator = $locator;
        $this->ordinalPosition = $ordinalPosition;
    }

    public function __toString(): string
    {
        $locatorCharacters = preg_split('//u', $this->locator, -1, PREG_SPLIT_NO_EMPTY);

        $string = self::DELIMITER;

        if (is_array($locatorCharacters)) {
            foreach ($locatorCharacters as $character) {
                if (self::DELIMITER === $character) {
                    $string .= self::DELIMITER_ESCAPE . $character;
                } else {
                    $string .= $character;
                }
            }
        }

        $string .= self::DELIMITER;

        if (null !== $this->ordinalPosition) {
            $string .= self::POSITION_DELIMITER . $this->ordinalPosition;
        }

        return $string;
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
