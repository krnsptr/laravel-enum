<?php

namespace Krnsptr\LaravelEnum;

use BenSampo\Enum\FlaggedEnum;

class LaravelEnumFlagged extends FlaggedEnum
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
        if (!isset($this->description) && $this->hasMultipleFlags()) {
            return implode(', ', $this->getFlags());
        }

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
            'None',
            'All',
        ];
    }

    /**
     * Get all of the flag values in enum.
     *
     * @return array
     */
    public function getFlagValues(): array
    {
        return array_map(fn ($flag) => $flag->value, $this->getFlags());
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
        return parent::getDescription($value);
    }

    public static function All(): static
    {
        $constant = get_called_class() . '::All';

        if (defined($constant)) {
            $value = constant($constant);
        } else {
            $value = array_reduce(static::getValues(), fn ($carry, $item) => $carry |= $item, 0);
        }

        return new static($value);
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
    public static function coerceByPattern(string $value): ?static
    {
        $result = 0;

        $values = explode(',', $value);

        foreach ($values as $value) {
            $value = trim($value);

            foreach (static::patterns() as $pattern => $target) {
                if (preg_match($pattern, $value)) {
                    $result |= $target;

                    break;
                }
            }
        }

        return new static($result);
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
