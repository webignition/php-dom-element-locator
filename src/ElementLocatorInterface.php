<?php

namespace webignition\DomElementLocator;

interface ElementLocatorInterface
{
    public function getLocator(): string;
    public function getOrdinalPosition(): ?int;
    public function isCssSelector(): bool;
    public function isXpathExpression(): bool;
}
