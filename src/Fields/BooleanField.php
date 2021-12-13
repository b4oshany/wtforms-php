<?php

namespace WTForms\Fields;

use WTForms\Widgets\BooleanWidget;


class BooleanField extends Field {

    /**
     * Create a field object.
     * @param string $label - Label for the field.
     * @uses WTForms\Widgets\BooleanWidget
     */
    public function __construct($label) {
        parent::__construct($label);
        $this->widget = new BooleanWidget();
        $this->type = 'checkbox';
    }

}
