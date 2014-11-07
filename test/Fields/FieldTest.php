<?php


class TestField extends WTForms\Fields\Field
{
    public function getForm()
    {
        return $this->_form;
    }
}


class FieldTest extends PHPUnit_Framework_TestCase
{


    public function test_construct()
    {
        try{
            $field = new TestField("My Name");
            $this->assertEquals("My Name",$field->label);
            $this->assertFalse($field->required);
            $this->assertEquals("",$field->help);
            $this->assertEquals("",$field->error);
            $this->assertEquals("",$field->css_class);
            $this->assertNull($field->id);
            $this->assertNull($field->default_value);
            $this->assertNull($field->value);
        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }


    public function test_set_name()
    {
        try{
            $field = new TestField("My Name");
            $field->setName("myname");
            $this->assertEquals("My Name",$field->label);
            $this->assertFalse($field->required);
            $this->assertEquals("myname",$field->id);
            $this->assertEquals("myname",$field->name);
            $this->assertEquals("",$field->help);
            $this->assertEquals("",$field->error);
            $this->assertEquals("",$field->css_class);
            $this->assertNull($field->default_value);
            $this->assertNull($field->value);
        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }


    public function test_set_name_when_struct()
    {
        try{
            $field = new TestField("My Name");
            $field->setName("struct[myname]");
            $this->assertEquals("My Name",$field->label);
            $this->assertFalse($field->required);
            $this->assertEquals("struct_myname_",$field->id);
            $this->assertEquals("struct[myname]",$field->name);
            $this->assertEquals("",$field->help);
            $this->assertEquals("",$field->error);
            $this->assertEquals("",$field->css_class);
            $this->assertNull($field->default_value);
            $this->assertNull($field->value);
        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }


    public function test_set_form()
    {
        try{
            $field = new TestField("My Name");
            $form = (object)array('fake');
            $field->setForm($form);
            $this->assertEquals($form,$field->getForm());
        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }


    public function test_required()
    {
        try{
            $field = new TestField("My Name");
            $form = (object)array('fake');
            $field->setForm($form);

            $this->assertFalse($field->required);
            $this->assertEquals(0,count($field->validators));

            $field->required();

            $this->assertTrue($field->required);
            $this->assertTrue(array_key_exists("WTForms\Validators\InputRequiredValidator",$field->validators));

        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }


    public function test_set_attributes()
    {
        try{

            $attributes = ['id','default_value','value','css_class','help'];

            $field = new TestField("My Name");
            foreach($attributes as $attr) {
                $new_value = 'value '.$attr;
                $field->$attr($new_value);
                $this->assertEquals($new_value,$field->$attr);
            }
        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }


    public function test_build_complete()
    {
        try{
            $field = (new TestField("My Name"))
                            ->setName("struct[myname]")
                            ->required()
                            ->id("other_strange_id")
                            ->help("this is important")
                            ->default_value("Jonh Doe")
                            ->css_class("important");
                    ;



            $this->assertEquals("My Name",$field->label);
            $this->assertTrue($field->required);
            $this->assertEquals("other_strange_id",$field->id);
            $this->assertEquals("struct[myname]",$field->name);
            $this->assertEquals("this is important",$field->help);
            $this->assertEquals("",$field->error);
            $this->assertEquals("important",$field->css_class);
            $this->assertEquals("Jonh Doe",$field->default_value);
            $this->assertNull($field->value);
        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_validate_required()
    {
        try{
            $field = (new TestField("My Name"))
                            ->setName("myname")
                            ->value("Name")
                            ->required();


            $this->assertEquals("My Name",$field->label);
            $this->assertTrue($field->required);

            $this->assertTrue($field->validate());

        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }


    public function test_validate_required_fails_when_null()
    {
        try{
            $field = (new TestField("My Name"))->setName("myname")->required();
            $this->assertFalse($field->validate());
            $this->assertEquals(['Missing data in required field'],$field->errors);

        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }


    public function test_validate_required_fails_when_empty()
    {
        try{
            $field = (new TestField("My Name"))->setName("myname")->required()->value('');
            $this->assertFalse($field->validate());
            $this->assertEquals(['Missing data in required field'],$field->errors);

        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }



}
