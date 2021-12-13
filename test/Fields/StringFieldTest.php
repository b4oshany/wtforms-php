<?php

class StringFieldTest extends PHPUnit_Framework_TestCase {

    public function test_validate_string() {
        try {
            $field = (new WTForms\Fields\StringField("My Name"))->setName("myname")->value("Name")->required();
            $this->assertEquals("My Name",$field->label);
            $this->assertTrue($field->required);
            $this->assertTrue($field->validate());
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_validate_string_fails_empty() {
        try {
            $field = (new WTForms\Fields\StringField("My Name"))->setName("myname")->required();
            $this->assertEquals("My Name",$field->label);
            $this->assertTrue($field->required);
            $this->assertFalse($field->validate());
            $this->assertEquals(["'' value does not appears a string",'Missing data in required field'],$field->errors);
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_validate_required_fails_when_int() {
        try {
            $field = (new WTForms\Fields\StringField("My Name"))->setName("myname")->value(3)->required();
            $this->assertFalse($field->validate());
            $this->assertEquals(["'3' value does not appears a string"],$field->errors);
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_validate_required_fails_when_double() {
        try {
            $field = (new WTForms\Fields\StringField("My Name"))->setName("myname")->required()->value(2.3);
            $this->assertFalse($field->validate());
            $this->assertEquals(["'2.3' value does not appears a string"],$field->errors);
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_validate_email() {
        try{
            $validator = new WTForms\Validators\EmailValidator();
            $field = (new WTForms\Fields\StringField("My Name"))
                    ->setName("myname")
                    ->value("user@example.com")
                    ->required()
                    ->validators($validator);
            $this->assertEquals("My Name",$field->label);
            $this->assertTrue($field->required);
            $this->assertTrue($field->validate());
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_validate_email_fail() {
        try {
            $validator = new WTForms\Validators\EmailValidator();
            $field = (new WTForms\Fields\StringField("My Name"))
                    ->setName("myname")
                    ->value("userexample.com")
                    ->required()
                    ->validators($validator);
            $this->assertEquals("My Name",$field->label);
            $this->assertTrue($field->required);
            $this->assertFalse($field->validate());
            $this->assertEquals(["'userexample.com' value does not appears a valid email"],$field->errors);
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_validate_url() {
        try {
            $validator = new WTForms\Validators\UrlValidator();
            $field = (new WTForms\Fields\StringField("My Name"))
                    ->setName("myname")
                    ->value("http://www.example.com/path?query=p")
                    ->required()
                    ->validators($validator);
            $this->assertEquals("My Name",$field->label);
            $this->assertTrue($field->required);
            $this->assertTrue($field->validate());
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_validate_url_fail() {
        try {
            $validator = new WTForms\Validators\UrlValidator();
            $field = (new WTForms\Fields\StringField("My Name"))
                    ->setName("myname")
                    ->value("userexample.com")
                    ->required()
                    ->validators($validator);
            $this->assertEquals("My Name",$field->label);
            $this->assertTrue($field->required);
            $this->assertFalse($field->validate());
            $this->assertEquals(["'userexample.com' value does not appears a valid url"],$field->errors);
        }
        catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

}
