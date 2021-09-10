<?php

declare(strict_types=1);

namespace Dgame\Cast\Collection;

/**
 * @template T
 *
 * @param callable(mixed): T       $typeEnsurance
 * @param array<int|string, mixed> $values
 *
 * @return array<int|string, T>
 */
function filter(callable $typeEnsurance, array $values): array
{
    $output = [];
    foreach ($values as $key => $value) {
        if ($value === null) {
            continue;
        }

        $value = $typeEnsurance($value);
        if ($value === null) {
            continue;
        }

        $output[$key] = $value;
    }

    return $output;
}

/**
 * @template T
 *
 * @param callable(mixed): T       $typeEnsurance
 * @param array<int|string, mixed> $values
 * @param callable(T): T           $callback
 *
 * @return array<int|string, T>
 */
function filterMap(callable $typeEnsurance, array $values, callable $callback): array
{
    return array_map($callback, filter($typeEnsurance, $values));
}
