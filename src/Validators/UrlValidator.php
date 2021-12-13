<?php

namespace WTForms\Validators;


class UrlValidator extends Validator {

    public function validate() {
        $ret = false;
        $alpha = "\p{L}\p{N}";
        if (is_string($this->_field->value) && !empty($this->_field->value)) {
            $urlpattern='/\b(';
            $urlpattern.='https?:\/\/'; #Scheme
            $urlpattern.="(([$alpha-]+\.)+"; #Domain
            $urlpattern.='([a-z]{2,3}|info|mobi|aero|coop|jobs|mobi|museum|name|travel))'; #TLD
            $urlpattern.='(:[0-9]{1,5})?'; #Port
            $urlpattern.='(\/[^ ]*)?'; #Query
            $urlpattern.=')\b/iu';

            $ret = preg_match($urlpattern,$this->_field->value);
        }

        if (!$ret) {
            $this->error = "'{$this->_field->value}' value does not appears a valid url";
        }
        
        return $ret;
    }

}
