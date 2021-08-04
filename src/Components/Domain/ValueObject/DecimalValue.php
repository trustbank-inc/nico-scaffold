<?php
declare(strict_types=1);

namespace Seasalt\NicoScaffold\Components\Domain\ValueObject;

/**
 * 小数点ありの数値の値オブジェクト
 */
trait DecimalValue
{
    /**
     * new禁止
     *
     * @param float $value
     * @see fromString()
     */
    private function __construct(private float $value)
    {

    }

    /**
     * プリミティブ型で値を取得する
     *
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * 最小値を取得する
     *
     * @return int
     */
    public static function getMinValue(): int
    {
        return PHP_INT_MIN;
    }

    /**
     * 最大値を取得する
     *
     * @return int
     */
    public static function getMaxValue(): int
    {
        return PHP_INT_MAX;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->getValue();
    }

    /**
     * 有効な値かどうか検証する
     *
     * @param float $value
     * @return bool
     */
    public static function isValidValue(float $value): bool
    {
        return $value >= static::getMinValue() && $value <= static::getMaxValue();
    }

    /**
     * インスタンス生成元として有効な文字列かどうか確認する
     *
     * @param string $value
     * @return bool
     */
    public static function isValidString(string $value): bool
    {
        if (filter_var($value, FILTER_VALIDATE_INT) === false &&
            filter_var($value, FILTER_VALIDATE_FLOAT) === false) {
            return false;
        }
        return self::isValidValue(intval($value));
    }

    /**
     * 数値からオブジェクトを生成する
     *
     * @param float $value
     * @return static
     */
    public static function fromNumber(float $value): static
    {
        if (!static::isValidValue($value)) {
            throw new InvalidValueException((string)$value, static::class);
        }
        return new static($value);
    }

    /**
     * 文字列からオブジェクトを生成する
     *
     * @param string $value
     * @return static
     */
    public static function fromString(string $value): static
    {
        if (!self::isValidString($value)) {
            throw new InvalidValueException($value, static::class);
        }
        return self::fromNumber(floatval($value));
    }
}
