<?php

declare(strict_types=1);

namespace Modules\Common\Application\DTOs;

use Modules\Common\Domain\Collections\LangCollection;

final class LangSetDto
{
    public function __construct(
        public readonly string $id,
        public readonly array $langs
    ) {}
}
