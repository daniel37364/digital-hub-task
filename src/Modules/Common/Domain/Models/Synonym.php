<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Models;

use Ramsey\Uuid\UuidInterface;

class Synonym
{
    private UuidInterface $id;
    private UuidInterface $nameLangSetId;

    private LangSet $nameLangSet;

    public function __construct(
        UuidInterface $id,
        UuidInterface $nameLangSetId,
        LangSet $nameLangSet
    ) {
        $this->id = $id;
        $this->nameLangSetId = $nameLangSetId;
        $this->nameLangSet = $nameLangSet;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getNameLangSetId(): UuidInterface
    {
        return $this->nameLangSetId;
    }

    public function getNameLang(string $langCode): Lang
    {
        return $this->nameLangSet->getLang($langCode);
    }
}
