<?php

namespace WTForms\Fields;

use WTForms\Widgets\RadioWidget;

/**
* Blueprint for a radio field.
* 
* @author Oshane Bailey <b4.oshany@gmail.com>
* @since 1.0
* @property array _options - Options for the radio field.
*/
class RadioField extends Field
{

    /**
     * Create a field object.
     * @param string $label - Label for the field.
     * @param array $options - Associated array of options.
     * @uses WTForms\Widgets\RadioWidget
     */
    public function __construct($label, $options=[])
    {
        parent::__construct($label);
        $this->setOptions($options);
        $this->widget = new RadioWidget();
        $this->type = 'radio';

    }

    /**
     * Remove option by key from the field.
     * @param string $key - Name of the option key.
     * @return self
     */
    public function removeOption($key){
        if(array_key_exists($name, $this->_options)){
            unset($this->_options[$key]);
        }
        return $this;
    }

    /**
     * Add or update option choice to the field.
     * @param string $key - Name of the option key.
     * @param string $value - Value of the option.
     * @return self
     */
    public function addOption($key, $value){
        $this->_options[$key] = $value;
        return $this;
    }


    /**
     * Get select options.
     * @returns array - Associated array with the key and value of the option.
     */
    public function options(){
        return $this->_options;
    }

    /**
     * Set options for the field.
     * @param array $options - Associated array of the field options.
     * @return self
     */
    public function setOptions($options){
        $this->_options = $options;
        return $this;
    }


}
