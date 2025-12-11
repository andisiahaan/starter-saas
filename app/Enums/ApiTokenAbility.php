<?php

namespace App\Enums;

enum ApiTokenAbility: string
{
    case CREATE = 'create';
    case READ = 'read';
    case UPDATE = 'update';
    case DELETE = 'delete';

    /**
     * Get human-readable label.
     */
    public function getLabel(): string
    {
        return __('enums.api_token_ability.labels.' . $this->value);
    }

    /**
     * Get description for the ability.
     */
    public function getDescription(): string
    {
        return __('enums.api_token_ability.descriptions.' . $this->value);
    }

    /**
     * Get all abilities as array for forms/selects.
     */
    public static function toArray(): array
    {
        return array_map(fn($case) => [
            'value' => $case->value,
            'label' => $case->getLabel(),
            'description' => $case->getDescription(),
        ], self::cases());
    }

    /**
     * Get all ability values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
