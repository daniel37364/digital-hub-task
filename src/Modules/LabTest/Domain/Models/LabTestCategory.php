<?php

declare(strict_types=1);

namespace Modules\LabTest\Domain\Models;

use Ramsey\Uuid\UuidInterface;
use Modules\Common\Domain\Models\Lang;
use Modules\Common\Domain\Models\LangSet;
use Modules\LabTest\Domain\Collections\LabTestCollection;

class LabTestCategory
{
    public function __construct(
        private UuidInterface $id,
        private UuidInterface $nameLangSetId,
        private bool $public,
        private bool $deleted,
        private int $ord,
        private LangSet $nameLangSet,
        private ?LabTestCollection $labTests = null,
    ) {
        $this->id = $id;
        $this->nameLangSetId = $nameLangSetId;
        $this->public = $public;
        $this->deleted = $deleted;
        $this->ord = $ord;
        $this->labTests = $labTests;
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

    public function getNameLangSet(): LangSet
    {
        return $this->nameLangSet;
    }

    public function updatePublic(bool $public): void
    {
        $this->public = $public;
    }
    public function updateOrd(int $ord): void
    {
        $this->ord = $ord;
    }
}
