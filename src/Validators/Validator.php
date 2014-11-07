<?php

namespace WTForms\Validators;

abstract class Validator
{
    public    $error  = null;
    protected $_form  = null;
    protected $_field = null;

    function __construct($form=null,$field=null)
    {
        $this->_form = $form;
        $this->_field = $field;
    }

    public function setField($field)
    {
        $this->_field = $field;
        return $this;
    }

    public function setForm($form)
    {
        $this->_form = $form;
        return $this;
    }

    abstract public function validate();

}