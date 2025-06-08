<?php

declare(strict_types=1);

namespace Modules\LabTest\Domain\Models;

use Ramsey\Uuid\UuidInterface;
use Modules\Common\Domain\Models\Lang;
use Modules\Common\Domain\Models\LangSet;
use Modules\LabTest\Domain\Collections\LabTestCollection;

class LabTestCategory
{
    private UuidInterface $id;
    private UuidInterface $nameLangSetId;
    private bool $public;
    private bool $deleted;
    private int $ord;

    private ?LabTestCollection $labTests = null;

    private LangSet $nameLangSet;
    private LangSet $descriptionLangSet;



    public function __construct(
        UuidInterface $id,
        UuidInterface $nameLangSetId,
        bool $public,
        bool $deleted,
        int $ord,
        ?LabTestCollection $labTests = null,
        LangSet $nameLangSet,
        LangSet $descriptionLangSet
    ) {
        $this->id = $id;
        $this->nameLangSetId = $nameLangSetId;
        $this->public = $public;
        $this->deleted = $deleted;
        $this->ord = $ord;
        $this->labTests = $labTests;
        $this->nameLangSet = $nameLangSet;
        $this->descriptionLangSet = $descriptionLangSet;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getNameLangSetId(): UuidInterface
    {
        return $this->nameLangSetId;
    }

    public function isPublic(): bool
    {
        return $this->public;
    }

    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    public function getOrd(): int
    {
        return $this->ord;
    }

    public function getLabTests(): LabTestCollection
    {
        return $this->labTests;
    }

    public function getNameLang(string $langCode): Lang
    {
        return $this->nameLangSet->getLang($langCode);
    }

    public function getDescriptionLang(string $langCode): Lang
    {
        return $this->descriptionLangSet->getLang($langCode);
    }
}
