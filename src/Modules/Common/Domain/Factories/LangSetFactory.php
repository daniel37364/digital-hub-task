<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Factories;

use Modules\Common\Domain\Models\LangSet;
use Modules\Common\Domain\Collections\LangCollection;
use Modules\Common\Domain\Models\Lang;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;

class LangSetFactory
{
    public static function create(array $data): LangSet
    {
        $langSetId = Uuid::uuid4();

        return new LangSet(
            id: $langSetId,
            langs: new LangCollection(
                array_map(
                    fn($code, $value) => LangFactory::create(['id' => Uuid::uuid4(), 'langSetId' => $langSetId, 'code' => $code, 'value' => $value]),
                    array_keys($data),
                    $data
                )
            )
        );
    }
}
