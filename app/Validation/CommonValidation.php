<?php

declare(strict_types=1);

namespace App\Validation;

class CommonValidation
{
    const VALIDATE_RULE =  [
        'server' => [
            'one' => [
                'srv_id' => 'required'
            ],
        ],
    ];
    const VALIDATE_MESSAGE =  [
        'server' => [
            'one' => [],
        ],
    ];
    const VALIDATE_ATTRIBUTE =  [
        'server' => [
            'one' => [],
        ],
    ];



    public function rule($module, $action): array
    {
        return self::VALIDATE_RULE[$module][$action] ?? [];
    }

    public function message($module, $action): array
    {
        return self::VALIDATE_MESSAGE[$module][$action] ?? [];
    }

    public function attribute($module, $action): array
    {
        return self::VALIDATE_ATTRIBUTE[$module][$action] ?? [];
    }
}
