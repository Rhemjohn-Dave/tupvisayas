<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    public const TUPSTAT_HERO_ENABLED = 'tupstat_hero_enabled';

    public const USG_ABOUT = 'usg.about';

    public const USG_MISSION = 'usg.mission';

    public const USG_VISION = 'usg.vision';

    public const USG_CONTACT_EMAIL = 'usg.contact_email';

    public const USG_OFFICE_HOURS = 'usg.office_hours';

    protected $fillable = [
        'key',
        'value',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        $cacheKey = 'site_setting.'.$key;

        return Cache::rememberForever($cacheKey, function () use ($key, $default) {
            $row = static::query()->where('key', $key)->first();

            return $row?->value ?? $default;
        });
    }

    public static function setValue(string $key, mixed $value): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value === null ? null : (string) $value]
        );

        Cache::forget('site_setting.'.$key);
    }

    public static function boolean(string $key, bool $default = false): bool
    {
        $value = static::getValue($key, $default ? '1' : '0');

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    public static function setBoolean(string $key, bool $value): void
    {
        static::setValue($key, $value ? '1' : '0');
    }

    public static function tupstatHeroEnabled(): bool
    {
        return static::boolean(self::TUPSTAT_HERO_ENABLED, true);
    }
}
