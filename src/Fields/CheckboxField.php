<?php

namespace WTForms\Fields;

use WTForms\Widgets\CheckboxWidget;

class CheckboxField extends RadioField
{

    /**
     * Create a field object.
     * @param string $label - Label for the field.
     * @param array $options - Associated array of options.
     * @uses WTForms\Widgets\CheckboxWidget
     */
    public function __construct($label, $options=[])
    {
        parent::__construct($label, $options);
        $this->widget = new CheckboxWidget();
        $this->type = 'checkbox';
    }

}
