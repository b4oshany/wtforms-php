<?php

namespace WTForms\Fields;

use WTForms\Widgets\BooleanWidget;

class BooleanField extends Field
{
    public function __construct($label)
    {
        $this->widget = new BooleanWidget();
        parent::__construct($label);
        $this->type = 'checkbox';
    }
}
