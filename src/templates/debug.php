<?php

?>
<form action="<?php echo $_wtform->getUrl(); ?>" method="<?php echo $_wtform->getMethod(); ?>">

<?php
foreach ($_wtform->getFields() as $field):
?>
    <?php if ($field->type==WTForms\Field::HIDDEN): ?>
    <input  name="<?php echo $field->name;?>" value="<?php echo $field->initial;?>" type="hidden"/>
    <?php elseif ($field->type==WTForms\Field::TEXTAREA): ?>
    <label><?php echo $field->label;?></label>
    <textarea  name="<?php echo $field->name;?>" id="<?php echo $field->id;?>" placeholder="<?php echo $field->help;?>" <?php if($field->required): ?>required <?php endif;?>><?php echo $field->initial;?></textarea>
    <br/>
    <?php elseif (in_array($field->type, [WTForms\Field::TEXT,WTForms\Field::INTEGER,WTForms\Field::EMAIL,WTForms\Field::URL])): ?>
    <label><?php echo $field->label;?></label>
    <input  name="<?php echo $field->name;?>" value="<?php echo $field->initial;?>" id="<?php echo $field->id;?>" placeholder="<?php echo $field->help;?>" <?php if ($field->required): ?>required <?php endif;?> type="<?php echo $field->type;?>"/>
    <br/>
    <?php endif; ?>
<?php
endforeach;
?>

</form>