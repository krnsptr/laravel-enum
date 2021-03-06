<?php

namespace Krnsptr\LaravelEnum;

use BenSampo\Enum\Enum;

class LaravelEnum extends Enum
{
    public const DETAIL = [];

    public array $detail = [];

    /**
     * Construct an Enum instance.
     *
     * @param  mixed  $enumValue
     * @return void
     */
    public function __construct($enumValue)
    {
        parent::__construct($enumValue);

        $this->detail = static::getDetail($enumValue);
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
            'DETAIL',
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
     * Get the description for an enum value
     *
     * @param  mixed  $value
     * @return string
     */
    public static function getDescription($value): string
    {
        if (isset(static::DETAIL[$value]['text'])) {
            return static::DETAIL[$value]['text'];
        }

        return parent::getDescription($value);
    }

    /**
     * Get the detail for an enum value
     *
     * @param  mixed  $value
     * @return string
     */
    public static function getDetail($value): array
    {
        if (isset(static::DETAIL[$value])) {
            return static::DETAIL[$value];
        }

        return [];
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
    public static function coerce($enumKeyOrValue): ?self
    {
        $enum = parent::coerce($enumKeyOrValue);

        if ($enum === null && is_string($enumKeyOrValue)) {
            $enum = static::coerceByPattern($enumKeyOrValue);
        }

        return $enum;
    }
}
