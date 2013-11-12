<?php

namespace Alterway\DemoBundle\Controller;

use Alterway\Bundle\RestProblemBundle\Controller\Annotations\Problem;
use Alterway\Bundle\RestProblemBundle\Response\ProblemResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Alterway\Bundle\RestProblemBundle\Problem\InvalidQueryForm;

class TestController extends Controller
{

    public function userWithoutAnnotateAction(Request $request)
    {

        $form = $this->get('form.factory')->createNamedBuilder(null, 'form')
                ->add('email', 'email', array('constraints' => new Email()))
                ->add('name', 'url', array('constraints' => new Length(15)))
                ->getForm();

        // start here
        $form->bind($request);
        if (!$form->isValid()) {
            $problem = new InvalidQueryForm($form);

            // or
            // $problem = new Problem\InvalidQuery($form->getErrors());

            return new ProblemResponse($problem);
        }
    }

    /**
     * @Problem
     */
    public function directProblemAction(Request $request)
    {

        $form = $this->get('form.factory')->createNamedBuilder(null, 'form')
            ->add('email', 'email', array('constraints' => new Email()))
            ->add('name', 'url', array('constraints' => new Length(15)))
            ->getForm();
       

        // start here
        $form->bind($request);
        if (!$form->isValid()) {
            return new InvalidQueryForm($form);
        }
    }

    public function exceptionProblemAction()
    {
        throw new \Exception('Something went wrong!');
    }

}