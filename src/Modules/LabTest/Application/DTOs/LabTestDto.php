<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\DTOs;

use Modules\Common\Application\DTOs\LangSetDto;
use Ramsey\Uuid\Uuid;

final class LabTestDto
{
    public function __construct(
        public readonly ?string $id,
        public readonly int $code,
        public readonly string $code_icd,
        public readonly array $name,
        public readonly array $description,
        public readonly bool $public,
        public readonly bool $deleted,
        public readonly int $ord,

        public readonly ?array $categories = null,
    ) {}
}
