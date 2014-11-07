<?php

namespace WTForms;


class Form
{
    protected $_url    = null;
    protected $_method = null;

    protected $_fields = [];
    protected $_fields = [];
    protected $_engine = null;
    protected $_tpl    = null;
    protected $_errors = null;

    public function __construct($method='GET',$url='#')
    {
        $this->_url = $url;
        $this->_method = $method;
        $this->_loadFields();
    }


    public function getUrl()
    {
        return $this->_url;
    }

    public function getMethod()
    {
        return $this->_method;
    }


    public function validate()
    {
        foreach($this->_fields as $name=>$field) {
            if(!$field->validate()) $this->_errors[$name] = $field->errors;
        }
    }

    protected function _loadFields()
    {
        if(is_null($this->_fields)) {
            $this->setUp();
            foreach($this->_fields as $name=>$field) {
                $field->setName($name);
                $field->setForm($this);
            }
        }
    }

    // public function render()
    // {
    //     if(is_null($this->_tpl)) return new Exception("Render need a template file");
    //     $_wtform = $this;
    //     ob_start();
    //     include $this->_tpl;
    //     return ob_get_clean();
    // }

    public function getFields()
    {
        return $this->_fields;
    }

    public function loadRequest()
    {
        $this->_loadFields();
        foreach($this->_fields as $f) $f->loadRequest();
    }

}

