<?php

namespace Alterway\Bundle\RestProblemBundle\Problem;

/*
 * (c) 2013 La Ruche Qui Dit Oui!
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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

        $this->title = "Invalid query";
        $this->detail = $errors;
        $this->httpStatus = 400;
    }

}
