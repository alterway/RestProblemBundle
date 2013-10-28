<?php

namespace Alterway\Bundle\RestProblemBundle\Problem;

use Symfony\Component\Form\FormInterface;

/*
 * (c) 2013 La Ruche Qui Dit Oui!
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class InvalidQueryForm extends Problem
{
    public function __construct(FormInterface $form)
    {

        $this->title = "Invalid query form";
        $this->detail = array(
            'errors' => $this->buildErrorsTree($form),
        );
        $this->httpStatus = 400;
    }

    /**
     * Recursively builds a tree of form errors (including children errors).
     * Based on Form::getErrorsAsString() : https://github.com/symfony/Form/blob/master/Form.php#L750
     *
     * @param FormInterface $form
     */
    private function buildErrorsTree($form) {
        $errors = array();

        foreach ($form->getErrors() as $key => $error) {
            $errors[$key] = $error->getMessage();
        }

        foreach ($form->all() as $key => $child) {
            if ($child instanceOf FormInterface && $err = $this->buildErrorsTree($child)) {
                $errors[$key] = $err;
            }
        }

        return $errors;
    }
}
