<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Repositories;

use Modules\Common\Application\Mappers\LangSetMapper;
use Modules\Common\Domain\Models\LangSet;
use Modules\Common\Domain\Repositories\LangSetRepositoryInterface;
use Modules\Common\Infrastructure\EloquentModels\Lang as EloquentLang;
use Modules\Common\Infrastructure\EloquentModels\LangSet as EloquentLangSet;

class LangSetRepository implements LangSetRepositoryInterface
{

    public function save(LangSet $langSet): LangSet
    {
        $EloquentLangSet = EloquentLangSet::firstOrCreate([
            'id' => $langSet->getId() ? $langSet->getId()->toString() : null,
        ]);

        foreach ($langSet->getLangs() as $lang) {
            EloquentLang::updateOrCreate(
                [
                    'id' => $lang->getId() ? $lang->getId()->toString() : null,
                ],
                [
                    'lang_set_id' => $EloquentLangSet->id,
                    'code' => $lang->getCode(),
                    'value' => $lang->getValue()
                ]
            );
        }
        return LangSetMapper::fromDatabase(EloquentLangSet::with(['langs'])->find($EloquentLangSet->id)->toArray());
    }

    public function delete(string $id): void
    {
        $langSet = EloquentLangSet::findOrFail($id);
        $langSet->delete();
    }
}
