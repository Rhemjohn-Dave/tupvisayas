<?php

namespace App\Support;

final class CmsPermissions
{
    public const ACCESS_ADMIN = 'access admin';

    public const MANAGE_POSTS = 'manage posts';

    public const MANAGE_CATEGORIES = 'manage categories';

    public const MANAGE_CAROUSEL = 'manage carousel';

    public const MANAGE_TIPTTO = 'manage tiptto';

    public const MANAGE_DIRECTOR_POSTS = 'manage director posts';

    public const MANAGE_USERS = 'manage users';

    public const MANAGE_OFFICIALS = 'manage officials';

    public const VIEW_ACTIVITY_LOGS = 'view activity logs';

    public const MANAGE_ACADEMICS = 'manage academics';

    public const MANAGE_PROCUREMENTS = 'manage procurements';

    public const MANAGE_ADMISSIONS = 'manage admissions';

    /**
     * @return list<string>
     */
    public static function all(): array
    {
        return [
            self::ACCESS_ADMIN,
            self::MANAGE_POSTS,
            self::MANAGE_CATEGORIES,
            self::MANAGE_CAROUSEL,
            self::MANAGE_TIPTTO,
            self::MANAGE_DIRECTOR_POSTS,
            self::MANAGE_USERS,
            self::MANAGE_OFFICIALS,
            self::VIEW_ACTIVITY_LOGS,
            self::MANAGE_ACADEMICS,
            self::MANAGE_PROCUREMENTS,
            self::MANAGE_ADMISSIONS,
        ];
    }

    /**
     * Human labels for the admin UI.
     *
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            self::ACCESS_ADMIN => 'Access admin panel',
            self::MANAGE_POSTS => 'News, announcements, jobs & events',
            self::MANAGE_CATEGORIES => 'Categories',
            self::MANAGE_CAROUSEL => 'Homepage carousel',
            self::MANAGE_TIPTTO => 'TIPTTO / ADRE posts',
            self::MANAGE_DIRECTOR_POSTS => "Director's Corner",
            self::MANAGE_USERS => 'Users & roles',
            self::MANAGE_OFFICIALS => 'Officials',
            self::VIEW_ACTIVITY_LOGS => 'Activity logs',
            self::MANAGE_ACADEMICS => 'Academics pages',
            self::MANAGE_PROCUREMENTS => 'Bidding / procurement',
            self::MANAGE_ADMISSIONS => 'Admission test schedules',
        ];
    }
}
