<?php

namespace WTForms\Widgets;


/**
* Blueprint for a field widget.
* 
* @author Oshane Bailey <b4.oshany@gmail.com>
* @since 1.0
* @property array _options - Options for the radio field.
*/
abstract class Widget {

    /**
     * Generate the HTML attributes for the given field.
     * @param WTForms\Fields\Field $field - Generate the HTML attribute from the given field.
     * @return string - List of attributes in the format "attribute=value"
     */
    protected function renderAttrs($field) {
        $attrs = "";
        foreach ($field->attrs as $key => $value) {
            $attrs .= "$key='$value' ";
        }
        return $attrs;
    }

    /**
     * Return the HTML output for the given field.
     * @param WTForms\Fields\Field $field - Render the HTML field using the given field.
     * @return string - HTML output for the given field.
     */
    public function render($field) {
        $attrs = $this->renderAttrs($field);

        $html = "<input type='$field->type' name='$field->name'"
                ." id='$field->id' value='$field->value' $attrs"
                ." class='form-control $field->css_class' placeholder='$field->label' ";
        if ($field->required) {
            $html .= "required ";
        }
        $html .= "/>";
        return $html;
    }

    /**
     * Return the HTML label for the given field.
     * @param WTForms\Fields\Field $field - Return the HTML field label using the given field.
     * @return string - HTML label for the given field.
     */
    public function label($field) {
        return "<label for='$field->id'>$field->label</label>";
    }

}

?>