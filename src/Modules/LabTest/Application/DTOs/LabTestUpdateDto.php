<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\DTOs;

use Ramsey\Uuid\UuidInterface;

class LabTestUpdateDto
{
    public function __construct(
        public readonly string $id,
        public readonly ?array $name = null,
        public readonly ?array $description = null,
        public readonly ?int $code = null,
        public readonly ?string $codeIcd = null,
        public readonly ?bool $public = null,
    ) {}
}
