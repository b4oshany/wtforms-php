<?php

namespace WTForms\Validators;


class InputRequiredValidator extends Validator {

    public function validate() {
        if (is_null($this->_field->value) || empty($this->_field->value)) {
            $this->error = "Missing data in required field";
            return false;
        }

        return true;
    }

}

?>