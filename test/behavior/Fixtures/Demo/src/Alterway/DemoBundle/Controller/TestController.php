<?php

namespace Alterway\DemoBundle\Controller;

use Alterway\Bundle\RestProblemBundle\Problem;
use Alterway\Bundle\RestProblemBundle\Response\ProblemResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class TestController extends Controller
{

    public function userWithoutAnnotateAction(Request $request)
    {

        $collectionConstraint = new Collection(array(
            'fields' => array(
                'email' => new Email(),
                'name' => new Length(15),
            ),
            'allowExtraFields' => false));
        $form = $this->get('form.factory')->createNamedBuilder(null, 'form', array(), array(
                    'validation_constraint' => $collectionConstraint,
                ))
                ->add('email', 'email')
                ->add('name', 'url')
                ->getForm()
        ;

        // start here

        $form->bind($request);
        if (!$form->isValid()) {
            $problem = new Problem\InvalidQueryForm($form);

            // or
            // $problem = new Problem\InvalidQuery($form->getErrors());

            return new ProblemResponse($problem, 403);
        }
    }

}