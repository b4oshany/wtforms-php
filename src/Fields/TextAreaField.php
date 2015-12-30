<?php

namespace WTForms\Fields;


class TextAreaField extends StringField
{

    /**
     * Create a field object.
     * @param string $label - Label for the field.
     * @uses WTForms\Widgets\TextAreaWidget
     */
    public function __construct($label,$validators=[],$options=[])
    {
        parent::__construct($label,$validators,$options);
        $this->widget = new TextAreaWidget();
        $this->type = 'textarea';
    }



}