<?php

declare(strict_types=1);

namespace Modules\LabTest\Domain\Models;

use Ramsey\Uuid\UuidInterface;
use Modules\Common\Domain\Models\Lang;
use Modules\Common\Domain\Models\LangSet;
use Modules\LabTest\Domain\Collections\LabTestCategoryCollection;

class LabTest
{
    public function __construct(
        private UuidInterface $id,
        private int $code,
        private string $codeIcd,
        private UuidInterface $nameLangSetId,
        private UuidInterface $descriptionLangSetId,
        private bool $public,
        private bool $deleted,
        private int $ord,
        private LangSet $nameLangSet,
        private LangSet $descriptionLangSet,
        private ?LabTestCategoryCollection $categories = null,
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->codeIcd = $codeIcd;
        $this->nameLangSetId = $nameLangSetId;
        $this->descriptionLangSetId = $descriptionLangSetId;
        $this->public = $public;
        $this->deleted = $deleted;
        $this->ord = $ord;
        $this->categories = $categories;
        $this->nameLangSet = $nameLangSet;
        $this->descriptionLangSet = $descriptionLangSet;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getCodeIcd(): string
    {
        return $this->codeIcd;
    }

    public function getNameLangSetId(): UuidInterface
    {
        return $this->nameLangSetId;
    }

    public function getNameLangSet(): LangSet
    {
        return $this->nameLangSet;
    }

    public function getDescriptionLangSetId(): UuidInterface
    {
        return $this->descriptionLangSetId;
    }
    public function getDescriptionLangSet(): LangSet
    {
        return $this->descriptionLangSet;
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

    public function getCategories(): LabTestCategoryCollection
    {
        return $this->categories;
    }
    public function getNameLang(string $langCode): Lang
    {
        return $this->nameLangSet->getLang($langCode);
    }
    public function updateCode(int $code): void
    {
        $this->code = $code;
    }
    public function updateCodeIcd(string $codeIcd): void
    {
        $this->codeIcd = $codeIcd;
    }
    public function updatePublic(bool $public): void
    {
        $this->public = $public;
    }
}
