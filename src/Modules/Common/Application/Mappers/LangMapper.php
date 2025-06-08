<?php

declare(strict_types=1);

namespace Modules\Common\Application\Mappers;

use Ramsey\Uuid\Uuid;
use Modules\Common\Domain\Models\Lang;
use Modules\Common\Application\DTOs\LangDto;
use Modules\Common\Infrastructure\EloquentModels\Lang as LangEloquent;

class LangMapper
{
    public static function fromArray(array $lang): LangDto
    {
        return new LangDto(
            id: $lang['id'],
            value: $lang['value'],
            code: $lang['code']
        );
    }

    public static function fromDatabase(array $data): Lang
    {
        return new Lang(
            id: $data['id'] ? Uuid::fromString($data['id']) : null,
            langSetId: $data['lang_set_id'] ? Uuid::fromString($data['lang_set_id']) : null,
            value: $data['value'],
            code: $data['code']
        );
    }

    public static function toDto(Lang $lang): LangDto
    {
        return new LangDto(
            id: $lang->getId()->toString(),
            value: $lang->getValue(),
            code: $lang->getCode()
        );
    }
}
