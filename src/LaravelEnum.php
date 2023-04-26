<?php

namespace Krnsptr\LaravelEnum;

use BenSampo\Enum\Enum;

class LaravelEnum extends Enum
{
    /**
     * Construct an Enum instance.
     *
     * @param  mixed  $enumValue
     * @return void
     */
    public function __construct($enumValue)
    {
        parent::__construct($enumValue);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) static::getDescription($this->value);
    }

    /**
     * Get removed constants for enum.
     *
     * @return array
     */
    protected static function removedConstants(): array
    {
        return [
        ];
    }

    /**
     * Get all of the constants defined on the class.
     *
     * @return array
     */
    protected static function getConstants(): array
    {
        $constants = parent::getConstants();

        $removed_keys = array_merge(static::removedConstants(), static::removedConstants());

        return array_diff_key($constants, array_flip($removed_keys));
    }

    /**
     * Get patterns for coercing.
     *
     * @return array
     */
    protected static function patterns(): array
    {
        return [];
    }

    /**
     * Coerce by pattern.
     *
     * @return static
     */
    protected static function coerceByPattern(string $value): ?static
    {
        $result = null;

        foreach (static::patterns() as $pattern => $target) {
            if (preg_match($pattern, $value)) {
                $result = $target;

                break;
            }
        }

        return static::coerce($result);
    }

    /**
     * Attempt to instantiate a new Enum using the given key or value.
     *
     * @param  mixed  $enumKeyOrValue
     * @return static|null
     */
    public static function coerce($enumKeyOrValue): ?static
    {
        $enum = parent::coerce($enumKeyOrValue);

        if ($enum === null && is_string($enumKeyOrValue)) {
            $enum = static::coerceByPattern($enumKeyOrValue);
        }

        return $enum;
    }
}
