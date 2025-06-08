<?php

declare(strict_types=1);

namespace Modules\Common\Application\Mappers;

use Modules\Common\Application\DTOs\LangSetDto;
use Modules\Common\Domain\Collections\LangCollection;
use Modules\Common\Domain\Models\LangSet;
use Modules\Common\Infrastructure\EloquentModels\LangSet as LangSetEloquent;
use Ramsey\Uuid\Uuid;

class LangSetMapper
{
    public static function fromArray(array $langSet): LangSetDto
    {
        return new LangSetDto(
            id: $langSet['id'],
            langs: array_map(
                fn($lang) => LangMapper::fromArray($lang),
                $langSet['langs']
            )
        );
    }

    public static function fromDatabase(array $data): LangSet
    {
        return new LangSet(
            id: $data['id'] ? Uuid::fromString($data['id']) : null,
            langs: new LangCollection($data['langs'] ? array_map(
                fn($lang) => LangMapper::fromDatabase($lang),
                $data['langs']
            ) : [])
        );
    }

    public static function toDto(LangSet $langSet): LangSetDto
    {
        return new LangSetDto(
            id: $langSet->getId()->toString(),
            langs: array_reduce(
                $langSet->getLangs()->toArray(),
                fn($carry, $lang) => $carry + [$lang->getCode() => $lang->getValue()],
                []
            )
        );
    }
}
