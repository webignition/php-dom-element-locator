<?php

namespace webignition\DomElementLocator;

use webignition\DomElementLocator\Enum\Type;

interface ElementLocatorInterface
{
    public function __toString(): string;

    public function getLocator(): string;

    public function getOrdinalPosition(): ?int;

    public function isCssSelector(): bool;

    public function isXpathExpression(): bool;

    public function getType(): ?Type;
}
