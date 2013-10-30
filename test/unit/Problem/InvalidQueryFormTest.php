<?php

/**
 * @covers \Alterway\Bundle\RestProblemBundle\Problem\InvalidQueryForm
 */
class InvalidQueryFormTest extends PHPUnit_Framework_TestCase
{

    public function testDetailsOfInvalidFormAreGiven()
    {

        // we cannot get a mock of \Symfony\Component\Form\FormInterface
        // this will be fixed in PHPUnit 3.8
        // @see https://github.com/sebastianbergmann/phpunit-mock-objects/issues/103
        // $form = $this->getMock('\Symfony\Component\Form\FormInterface', array('all', 'getErrors'));
        $form = $this->getMock('\Symfony\Component\Form\Form', array('all', 'getErrors'), array(), '', false);
        $child = $this->getMock('\Symfony\Component\Form\Form', array('all', 'getErrors'), array(), '', false);
        $error1 = new \Symfony\Component\Form\FormError("an error occured in the root form");
        $error2 = new \Symfony\Component\Form\FormError("an error occured in a child form");
        
        $form
                ->expects($this->once())
                ->method('getErrors')
                ->will($this->returnValue(array($error1)))
        ;
        $form
                ->expects($this->once())
                ->method('all')
                ->will($this->returnValue(array('child' => $child)))
        ;

        $child
                ->expects($this->once())
                ->method('getErrors')
                ->will($this->returnValue(array($error2)))
        ;
        $child
                ->expects($this->once())
                ->method('all')
                ->will($this->returnValue(array()))
        ;

        $object = new \Alterway\Bundle\RestProblemBundle\Problem\InvalidQueryForm($form);
        $expected = array(
            'errors' => array(
                'an error occured in the root form',
                'child' => array('an error occured in a child form'),
            ),
        );
        $this->assertEquals($expected, $object->getDetail());
    }
    
    public function testNoProblemIsFoundWhenFormIsValid()
    {

        // we cannot get a mock of \Symfony\Component\Form\FormInterface
        // this will be fixed in PHPUnit 3.8
        // @see https://github.com/sebastianbergmann/phpunit-mock-objects/issues/103
        // $form = $this->getMock('\Symfony\Component\Form\FormInterface', array('all', 'getErrors'));
        $form = $this->getMock('\Symfony\Component\Form\Form', array('all', 'getErrors'), array(), '', false);
        
        
        $form
                ->expects($this->once())
                ->method('getErrors')
                ->will($this->returnValue(array()))
        ;
        $form
                ->expects($this->once())
                ->method('all')
                ->will($this->returnValue(array()))
        ;

        $object = new \Alterway\Bundle\RestProblemBundle\Problem\InvalidQueryForm($form);
        $expected = array('errors' => array());
        $this->assertEquals($expected, $object->getDetail());
    }

}
