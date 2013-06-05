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
        $formErrors = array();
        $formChildrenErrors = array();

        foreach ($form->getErrors() as $key => $error) {
            $formErrors['generic'][$key] = $error->getMessage() . ' [parameters: ' . implode(', ', $error->getMessageParameters()) . ']';
        }

        foreach ($form->all() as $key => $child) {
            if(!isset($errors[$key])) {
                $formChildrenErrors[$key] = array();
            }

            $childErrors = $child->getErrors();
            foreach($childErrors as  $err) {
                $formChildrenErrors[$key][] = $err->getMessage();
            }

            if (empty($formChildrenErrors[$key])) {
                unset($formChildrenErrors[$key]);
            }
        }

        $this->title = "Invalid query";
        $this->detail = array_merge($formErrors, $formChildrenErrors);
        $this->httpStatus = 400;
    }

}
