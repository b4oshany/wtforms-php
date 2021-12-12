<?php

use WTForms\Form;
use WTForms\Fields\StringField, WTForms\Fields\IntegerField, WTForms\Fields\TextAreaField;


class SimpleForm extends Form {

    function setUp() {
        $this->_fields = [
            'str_field' => new StringField('Str Field'),
            'int_field' => (new IntegerField('Integer Field'))->required()
        ];
    }

}


class ComplexForm extends Form {

    function setUp() {
        $this->_fields = [
            'first_name'         => (new StringField('First Name'))->required(),
            'last_name'          => (new StringField('Last Name'))->required(),
            'bio'                => (new TextAreaField('Bio'))->required()->help("Please, let us know more about you"),
            'birth_year'         => new IntegerField('Year of Birth'),
            'alias'              => new StringField('Alias/Nickname'),
            'address[street]'    => new StringField('Street'),
            'address[zip]'       => new StringField('Zip Code'),
            'address[city]'      => new StringField('City'),
            'address[state]'     => new StringField('State'),
            'phone'              => (new StringField('Phone Number'))->required(),
            'email'              => new StringField('Email address'),
            'url'                => (new StringField('Webpage'))->help("Url with http:// or https:// at the beginning"),
        ];
    }

}


class FormTest extends PHPUnit_Framework_TestCase {

    public function test_construct_empty_params() {
        try {
            $form = new SimpleForm();
            $this->assertEquals("GET",$form->getMethod());
            $this->assertEquals("#",$form->getUrl());
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_construct_with_params() {
        try {
            $form = new SimpleForm("POST","http://mydomain.com/myurl");
            $this->assertEquals("POST",$form->getMethod());
            $this->assertEquals("http://mydomain.com/myurl",$form->getUrl());
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_construct_check_fields() {
        try {
            $form = new SimpleForm();
            $fields = $form->getFields();
            $this->assertEquals(2,count($fields));

            //order matters
            $this->assertEquals("WTForms\Fields\StringField",get_class($fields['str_field']));
            $this->assertEquals("str_field",$fields['str_field']->name);
            $this->assertFalse($fields['str_field']->required);

            $this->assertEquals("WTForms\Fields\IntegerField",get_class($fields['int_field']));
            $this->assertEquals("int_field",$fields['int_field']->name);
            $this->assertTrue($fields['int_field']->required);
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_construct_check_fields_complex_form() {
        try {
            $form = new ComplexForm();
            $fields = $form->getFields();
            $this->assertEquals(12,count($fields));

            //order matters
            $this->assertEquals("WTForms\Fields\StringField",get_class($fields['first_name']));
            $this->assertEquals("first_name",$fields['first_name']->name);
            $this->assertEquals("First Name",$fields['first_name']->label);
            $this->assertTrue($fields['first_name']->required);
            $this->assertEquals("",$fields['first_name']->help);
            $this->assertEquals("first_name",$fields['first_name']->id);

            $this->assertEquals("WTForms\Fields\StringField",get_class($fields['last_name']));
            $this->assertEquals("last_name",$fields['last_name']->name);
            $this->assertEquals("Last Name",$fields['last_name']->label);
            $this->assertTrue($fields['last_name']->required);
            $this->assertEquals("",$fields['last_name']->help);
            $this->assertEquals("last_name",$fields['last_name']->id);

            $this->assertEquals("WTForms\Fields\TextAreaField",get_class($fields['bio']));
            $this->assertEquals("bio",$fields['bio']->name);
            $this->assertEquals("Bio",$fields['bio']->label);
            $this->assertTrue($fields['bio']->required);
            $this->assertEquals("Please, let us know more about you",$fields['bio']->help);
            $this->assertEquals("bio",$fields['bio']->id);

            $this->assertEquals("WTForms\Fields\IntegerField",get_class($fields['birth_year']));
            $this->assertEquals("birth_year",$fields['birth_year']->name);
            $this->assertEquals("Year of Birth",$fields['birth_year']->label);
            $this->assertFalse($fields['birth_year']->required);
            $this->assertEquals("",$fields['birth_year']->help);
            $this->assertEquals("birth_year",$fields['birth_year']->id);

            $this->assertEquals("WTForms\Fields\StringField",get_class($fields['address[street]']));
            $this->assertEquals("address[street]",$fields['address[street]']->name);
            $this->assertEquals("Street",$fields['address[street]']->label);
            $this->assertFalse($fields['address[street]']->required);
            $this->assertEquals("",$fields['address[street]']->help);
            $this->assertEquals("address_street_",$fields['address[street]']->id);
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    /*
    public function test_render_complex_form() {
        try {
            $form = new ComplexForm();
            $form->setTemplate(dirname(__FILE__).'/../src/templates/debug.php');
            $html = $form->render();
            $this->assertEquals("",$html);
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }
    */

}

?>