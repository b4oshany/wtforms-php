<?php

namespace WTForms\Validators;


class EmailValidator extends Validator {

    public function validate() {
        $ret = false;
        if (is_string($this->_field->value) && !empty($this->_field->value)) {
            $alpha = "\p{L}\p{N}";
            $emailpattern ="/^([$alpha\_\.\-\+])+\@(([$alpha\-])+\.)+([$alpha]{2,4})+$/u";

            $ret = @preg_match($emailpattern,$this->_field->value);

            if ($ret === false) {
                $alpha = "a-zA-Z0-9";
                $emailpattern ="/^([$alpha\_\.\-\+])+\@(([$alpha\-])+\.)+([$alpha]{2,4})+$/";
                $ret = preg_match($emailpattern,$this->_field->value);
            }
        }

        if(!$ret) {
            $this->error = "'{$this->_field->value}' value does not appears a valid email";
        }
        
        return $ret;
    }

}

?>