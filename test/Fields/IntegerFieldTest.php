<?php



class IntegerFieldTest extends PHPUnit_Framework_TestCase
{



    public function test_validate_integer()
    {
        try{
            $field = (new WTForms\Fields\IntegerField("My Name"))->setName("myname")->value(54)->required();


            $this->assertEquals("My Name",$field->label);
            $this->assertTrue($field->required);

            $this->assertTrue($field->validate());

        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_validate_integer_fails_empty()
    {
        try{
            $field = (new WTForms\Fields\IntegerField("My Name"))->setName("myname")->required();


            $this->assertEquals("My Name",$field->label);
            $this->assertTrue($field->required);

            $this->assertFalse($field->validate());
            $this->assertEquals(["'' value does not appears an integer",'Missing data in required field'],$field->errors);

        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function test_validate_required_fails_when_int()
    {
        try{
            $field = (new WTForms\Fields\IntegerField("My Name"))->setName("myname")->value(35.5)->required();
            $this->assertFalse($field->validate());
            $this->assertEquals(["'35.5' value does not appears an integer"],$field->errors);

        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }


    public function test_validate_required_fails_when_double()
    {
        try{
            $field = (new WTForms\Fields\IntegerField("My Name"))->setName("myname")->required()->value("string");
            $this->assertFalse($field->validate());
            $this->assertEquals(["'string' value does not appears an integer"],$field->errors);

        } catch(WTForms\Exception $e) {
            $this->fail($e->getMessage());
        }
    }



}