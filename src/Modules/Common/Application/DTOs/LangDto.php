<?php

declare(strict_types=1);

namespace Modules\Common\Application\DTOs;

final class LangDto
{
    public function __construct(
        public readonly string $id,
        public readonly string $value,
        public readonly string $code
    ) {}
}
