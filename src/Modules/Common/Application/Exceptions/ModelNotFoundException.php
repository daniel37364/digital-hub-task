<?php

declare(strict_types=1);

namespace Modules\Common\Application\Exceptions;

use Exception;

class ModelNotFoundException extends Exception
{
    public function __construct(string $model, string $id)
    {
        $message = "Model {$model} with ID {$id} not found.";
        parent::__construct($message);
    }
}
