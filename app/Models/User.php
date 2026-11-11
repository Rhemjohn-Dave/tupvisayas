<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Concerns\LogsModelActivity;
use App\Support\CmsPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CausesActivity, LogsModelActivity, HasRoles;

    protected array $activityLogAttributes = ['name', 'email', 'is_admin'];

    protected string $activityLogName = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    /**
     * Whether this account may use the admin panel.
     */
    public function canAccessAdmin(): bool
    {
        // Legacy flag first — avoids Spatie permission cache writes failing
        // hard when storage/ is not writable by the web server user.
        if ((bool) $this->is_admin) {
            return true;
        }

        try {
            return $this->hasRole('Administrator')
                || $this->can(CmsPermissions::ACCESS_ADMIN);
        } catch (\Throwable) {
            return false;
        }
    }

    /**
     * Preferred landing route after login for staff.
     */
    public function adminHomeRoute(): string
    {
        if ($this->can(CmsPermissions::MANAGE_POSTS) || $this->hasRole('Administrator')) {
            return route('admin.dashboard');
        }

        if ($this->can(CmsPermissions::MANAGE_PROCUREMENTS)) {
            return route('admin.procurements.index', ['type' => 'bid_opportunity']);
        }

        if ($this->can(CmsPermissions::MANAGE_ADMISSIONS)) {
            return route('admin.admission-schedules.index');
        }

        if ($this->can(CmsPermissions::MANAGE_ACADEMICS)) {
            return route('admin.college-pages.index');
        }

        if ($this->can(CmsPermissions::MANAGE_DIRECTOR_POSTS)) {
            return route('admin.director_posts.index');
        }

        if ($this->can(CmsPermissions::MANAGE_HR_POSTS)) {
            return route('admin.hr_posts.index');
        }

        if ($this->can(CmsPermissions::MANAGE_USG)) {
            return route('admin.usg-documents.index');
        }

        if ($this->can(CmsPermissions::MANAGE_TIPTTO)) {
            return route('admin.tiptto_posts.index');
        }

        if ($this->can(CmsPermissions::MANAGE_OFFICIALS)) {
            return route('admin.officials.index');
        }

        if ($this->can(CmsPermissions::MANAGE_CAROUSEL)) {
            return route('admin.carousel-images.index');
        }

        if ($this->can(CmsPermissions::MANAGE_USERS)) {
            return route('admin.users.index');
        }

        return route('admin.dashboard');
    }

    /**
     * Keep legacy is_admin in sync with the Administrator role.
     */
    public function syncAdminFlagFromRoles(): void
    {
        $this->forceFill([
            'is_admin' => $this->hasRole('Administrator'),
        ])->save();
    }
}
