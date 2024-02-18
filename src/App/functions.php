<?php

declare(strict_types=1);

function dd(mixed $value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

function escape(mixed $value): string
{
    return htmlspecialchars((string) $value);
}
