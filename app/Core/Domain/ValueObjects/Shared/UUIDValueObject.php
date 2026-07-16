<?php

namespace App\Core\Domain\ValueObjects\Shared;

use Ramsey\Uuid\Uuid as UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use InvalidArgumentException;

class UUIDValueObject
{
    private const NAMESPACE_GROUP = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';

    private UuidInterface $uuid;

    /**
     * Конструктор принимает строку UUID или создаёт новый UUID     *
     */
    public function __construct(string $value = null)
    {
        if ($value === null) {
            $this->uuid = UuidGenerator::uuid4();
        } else {
            if (!UuidGenerator::isValid($value)) {
                throw new InvalidArgumentException("Invalid UUID: {$value}");
            }
            $this->uuid = UuidGenerator::fromString($value);
        }
    }

    /**
     * Статический метод для создания нового UUID
     */
    public static function generate(): self
    {
        return new self();
    }

    /**
     * Статический метод для создания UUID из строки
     */
    public static function fromString(string $uuid): self
    {
        return new self($uuid);
    }

    /**
     * Детерминированный UUID v5 из частей (одинаковые части → одинаковый UUID)
     */
    public static function fromParts(string ...$parts): self
    {
        $namespace = UuidGenerator::fromString(self::NAMESPACE_GROUP);
        $name = implode('|', $parts);
        return new self(UuidGenerator::uuid5($namespace, $name)->toString());
    }

    /**
     * Получить строковое представление UUID
     */
    public function value(): string
    {
        return $this->uuid->toString();
    }

    /**
     * Сравнить два UUID на равенство
     */
    public function equals(UUIDValueObject $other): bool
    {
        return $this->value() === $other->value();
    }

    /**
     * Проверить, является ли UUID нулевым
     */
    public function isEmpty(): bool
    {
        return $this->value() === '00000000-0000-0000-0000-000000000000';
    }

    /**
     * Магический метод для строкового представления
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
