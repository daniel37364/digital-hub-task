<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Repositories;

use Modules\Common\Domain\Models\LangSet;


interface LangSetRepositoryInterface
{
    public function save(LangSet $langSet): LangSet;
    public function delete(string $id): void;
}
