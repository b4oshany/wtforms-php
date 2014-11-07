<?php

namespace WTForms\Validators;



class TypeValidator extends Validator
{

    function __construct($form,$field,$type)
    {
        $this->_form = $form;
        $this->_field = $field;
        $this->_type = $type;
    }

    public function validate()
    {
        switch($this->_type)
        {
            case 'string': return $this->_validate_string();break;
            case 'integer': return $this->_validate_integer();break;
            case 'float': return $this->_validate_float();break;
            case 'boolean': return $this->_validate_boolean();break;
            default: throw new WTForms\Exception("TypeValidator {$this->_type} is not supported");
        }
    }

    protected function _validate_string()
    {
        if(!is_string($this->_field->value)) {
            $this->error = "'{$this->_field->value}' value does not appears a string";
            return false;
        }

        return true;
    }

    protected function _validate_integer()
    {
        if(!is_int($this->_field->value)) {
            $this->error = "'{$this->_field->value}' value does not appears an integer";
            return false;
        }

        return true;
    }

    protected function _validate_float()
    {
        if(!is_float($this->_field->value)) {
            $this->error = "'{$this->_field->value}' value does not appears a float number";
            return false;
        }

        return true;
    }

}