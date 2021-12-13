<?php

namespace WTForms\Fields;

use WTForms\Widgets\SelectWidget;


class SelectField extends Field {

    protected $_options = [];

    /**
     * Create a field object.
     * @param string $label - Label for the field.
     * @param array $options - Associated array of options.
     * @uses WTForms\Widgets\SelectWidget
     */
    public function __construct($label, $options=[]) {
        parent::__construct($label);
        $this->widget = new SelectWidget();
        $this->setOptions($options);
        $this->type = "select";
    }

    /**
     * Remove select option choice by key.
     */
    public function removeOption($key) {
        if (array_key_exists($name, $this->_options)) {
            unset($this->_options[$key]);
        }
    }

    /**
     * Add/update select option choice.
     */
    public function addOption($key, $value) {
        $this->_options[$key] = $value;
    }


    /**
     * Get select options.
     * @returns array: Associated array with the key and value of the option.
     */
    public function options() {
        return $this->_options;
    }

    /**
     * Set options.
     */
    public function setOptions($options) {
        $this->_options = $options;
    }

}
