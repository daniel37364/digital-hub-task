<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Factories;

use Modules\Common\Domain\Models\Lang;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class LangFactory
{
    public static function create(array $data): Lang
    {
        return new Lang(
            id: $data['id'] ?? Uuid::uuid4(),
            langSetId: $data['langSetId'],
            code: $data['code'],
            value: $data['value']
        );
    }
}
