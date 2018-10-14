<?php

class Application_Form_Main extends Zend_Form
{
    public function init()
    {
        $add = new Zend_Form_Element_Button('add');
        $add->setLabel('Add Row');
        $add->setAttrib('class', 'button');
        
        $insert = new Zend_Form_Element_Button('insert');
        $insert->setLabel('Add Team');
        $insert->setAttrib('class', 'button');
        
        $this->addElements(array($add, $insert));
    }
}

?>