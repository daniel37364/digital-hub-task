<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Models;

use Modules\Common\Domain\Collections\LangCollection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class LangSet
{

    public function __construct(private UuidInterface $id, private LangCollection $langs)
    {
        $this->id = $id;
        $this->langs = $langs;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getLangs(): LangCollection
    {
        return $this->langs;
    }

    public function getLang(string $langCode): Lang
    {
        return $this->langs->toArray()[$langCode] ?? throw new \InvalidArgumentException("Language code '$langCode' not found in LangSet.");
    }

    public function updateLang(string $langCode, string $value): void
    {
        if (!$this->langs->has($langCode)) {
            $newLang = new Lang(
                id: Uuid::uuid4(),
                langSetId: $this->id,
                code: $langCode,
                value: $value
            );
            $this->langs->add($newLang);
        } else {
            $existingLang = $this->langs->get($langCode);
            $existingLang->updateValue($value);
        }
    }

    public function updateLangs(array $langs): void
    {
        foreach ($langs as $langCode => $value) {
            $this->updateLang($langCode, $value);
        }
    }
}
