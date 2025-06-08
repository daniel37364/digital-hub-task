<?php

declare(strict_types=1);

namespace Modules\LabTest\Presentation\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\LabTest\Application\DTOs\LabTestDto;

class LabTestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        dd($this);
        return [
            'id' => $this->id,
            'code' => $this->code,
            'codeIcd' => $this->codeIcd,
            'name' => $this->nameLangSet,
            'nameLangSetId' => $this->nameLangSetId,
            'descriptionLangSetId' => $this->descriptionLangSetId,
            'public' => $this->public,
            'deleted' => $this->deleted,
            'ord' => $this->ord,
            'categories' => $this->categories,
        ];
    }
}
