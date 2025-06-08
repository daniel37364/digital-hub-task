<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Models;

use Ramsey\Uuid\UuidInterface;

class Lang
{
    public function __construct(
        private UuidInterface $id,
        private UuidInterface $langSetId,
        private string $code,
        private string $value
    ) {
        $this->id = $id;
        $this->langSetId = $langSetId;
        $this->code = $code;
        $this->value = $value;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getLangSetId(): UuidInterface
    {
        return $this->langSetId;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function updateValue(string $value): void
    {
        $this->value = $value;
    }
}
