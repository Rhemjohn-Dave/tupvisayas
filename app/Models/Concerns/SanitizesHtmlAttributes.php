<?php

namespace App\Models\Concerns;

use App\Support\Html;

trait SanitizesHtmlAttributes
{
    /**
     * Attribute names that should be HTML-purified on write.
     * Override in the model: protected array $htmlAttributes = ['content'];
     *
     * @return list<string>
     */
    protected function htmlAttributes(): array
    {
        return property_exists($this, 'htmlAttributes')
            ? $this->htmlAttributes
            : ['content'];
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->htmlAttributes(), true) && is_string($value)) {
            $value = Html::clean($value);
        }

        return parent::setAttribute($key, $value);
    }
}
