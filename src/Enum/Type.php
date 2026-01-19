<?php

declare(strict_types=1);

namespace webignition\DomElementLocator\Enum;

enum Type: string
{
    case CSS = 'css';
    case XPATH = 'xpath';
}
