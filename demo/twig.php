<?php

require_once('../vendor/autoload.php');

use WTForms\Form, WTForms\Fields;


class AddressForm extends Form{
    function setUp(){
        $this->street = (new Fields\StringField("Street"));
        $this->street_name = (new Fields\StringField("Street"));
        $this->town = (new Fields\StringField("Town/District"))->required();
        $this->parish = (new Fields\SelectField("Parish"))->required();
        $this->country = (new Fields\StringField("Country"))->required();
    }
}

$current_page = $_SERVER["REQUEST_URI"];

$templates_dir = dirname(__FILE__)."/twig_templates";
$loader = new \Twig_Loader_Filesystem($templates_dir);
$twig = new \Twig_Environment($loader);
$twig->addGlobal("demo_url", dirname($current_page));

if(isset($_GET["page"])){
    $page = $_GET["page"];
    if($page == "address"){
        $address_form = new AddressForm();
        echo $twig->render("address.html", ["address_form"=>$address_form]);
    }
}

?>

<h3>List of Twig Pages available</h3>
<ul>
    <li><a href="?page=address">Address Form Page</a></li>
</ul>