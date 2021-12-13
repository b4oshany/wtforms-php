<?php

namespace WTForms;

use WTForms\Fields\Field;


class Form {

    protected $_url    = null;
    protected $_method = null;

    protected $_fields = [];
    protected $_engine = null;
    protected $_tpl    = null;
    protected $_errors = null;

    public function __construct($method='GET',$url='#')     {
        $this->_url = $url;
        $this->_method = $method;
        $this->_loadFields();
    }

    /**
    * Get values of the object
    *
    * @return mixed, value that is stored in a class variable
    */
    public function __get($name) {
        if (isset($this->$name)) {
            return $this->$name;
        }
        return null;
    }

    /**
    * Update the current form property or create a new field.
    * If the form doesn't have the given property, create a field.
    *
    * @param string $name, name of the class variable to be set
    * @param string $value, value to be set to the new class variable
    */
    public function __set($name, $value) {
        if ($value instanceof Field) {
            if (!isset($value->name)) {
                $value->name = $name;
            }
            if (!isset($value->id)) {
                $value->id = $name;
            }
            $this->{$name} = $value;
        }
    }

    public function getUrl() {
        return $this->_url;
    }

    public function getMethod() {
        return $this->_method;
    }

    public function validate() {
        foreach ($this->_fields as $name=>$field) {
            if (!$field->validate()) {
				$this->_errors[$name] = $field->errors;
			}
        }
    }

    protected function _loadFields() {
        if (count($this->_fields)==0) {
            $this->setUp();
            foreach ($this->_fields as $name=>$field) {
                $field->setName($name);
                $field->setForm($this);
            }
        }
    }

    /*
	public function render() {
        if (is_null($this->_tpl)) {
			return new Exception("Render need a template file");
		}
        $_wtform = $this;
        ob_start();
        include $this->_tpl;
        return ob_get_clean();
    }
	*/

    public function getFields() {
        if (empty($this->_fields)) {
            foreach ($this as $key => $value) {
                if ($value instanceof WTForms\Fields\Field) {
                    array_push($this->_fields, $value);
                }
            }
        }
        return $this->_fields;
    }

    public function loadRequest() {
        $this->_loadFields();
        foreach ($this->_fields as $f) {
			$f->loadRequest();
		}
    }

}
