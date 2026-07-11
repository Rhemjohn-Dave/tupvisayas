<?php

namespace App\Models\Concerns;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait LogsModelActivity
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        $options = LogOptions::defaults()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName($this->getActivityLogName());

        $attributes = $this->getActivityLogAttributes();

        if ($attributes === ['*']) {
            $options->logAll();
        } else {
            $options->logOnly($attributes);
        }

        return $options;
    }

    /**
     * @return list<string>
     */
    protected function getActivityLogAttributes(): array
    {
        return property_exists($this, 'activityLogAttributes')
            ? $this->activityLogAttributes
            : (property_exists($this, 'fillable') ? $this->fillable : ['*']);
    }

    protected function getActivityLogName(): string
    {
        return property_exists($this, 'activityLogName')
            ? $this->activityLogName
            : class_basename($this);
    }
}
