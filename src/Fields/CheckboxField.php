<?php

namespace WTForms\Fields;

use WTForms\Widgets\CheckboxWidget;

class CheckboxField extends RadioField
{

    public function __construct($label, $options=[])
    {
        parent::__construct($label, $options);
        $this->widget = new CheckboxWidget();
        $this->type = 'checkbox';
    }

}
