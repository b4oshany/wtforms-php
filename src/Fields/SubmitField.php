<?php

namespace WTForms\Fields;

use WTForms\Widgets\SubmitWidget;


class SubmitField extends StringField {

    public function __construct($label,$validators=[],$options=[])     {
        parent::__construct($label,$validators,$options);
        $this->widget = new SubmitWidget();
        $this->type = 'submit';
    }

}

?>