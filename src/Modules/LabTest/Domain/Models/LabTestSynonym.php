<?php

declare(strict_types=1);

namespace Modules\LabTest\Domain\Models;

use Modules\Common\Domain\Models\Synonym;
use Ramsey\Uuid\UuidInterface;

class LabTestSynonym
{
    private UuidInterface $id;
    private UuidInterface $labTestId;
    private UuidInterface $synonymId;

    private LabTest $labTest;
    private Synonym $synonym;

    public function __construct(
        UuidInterface $id,
        UuidInterface $labTestId,
        UuidInterface $synonymId,
        LabTest $labTest,
        Synonym $synonym
    ) {
        $this->id = $id;
        $this->labTestId = $labTestId;
        $this->synonymId = $synonymId;
        $this->labTest = $labTest;
        $this->synonym = $synonym;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getLabTestId(): UuidInterface
    {
        return $this->labTestId;
    }

    public function getSynonymId(): UuidInterface
    {
        return $this->synonymId;
    }
    public function getLabTest(): LabTest
    {
        return $this->labTest;
    }
    public function getSynonym(): Synonym
    {
        return $this->synonym;
    }
}
