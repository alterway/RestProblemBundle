<?php

namespace Alterway\Bundle\RestProblemBundle\Problem;

class InvalidQueryForm extends Problem
{

    public function __construct(\Symfony\Component\Form\FormInterface $form)
    {

        $errors = $form->getErrors();
        foreach ($form->all() as $key => $child) {
            if(!isset($errors[$key])) {
                $errors[$key] = array();
            }
            
            $childErrors = $child->getErrors();
            foreach($childErrors as  $err) {
                $errors[$key][] = $err->getMessage();
            }
        }

        $this->uri = "/query/invalid";
        $this->title = "Invalid query";
        $this->detail = $errors;
        $this->httpStatus = 400;
    }

}
