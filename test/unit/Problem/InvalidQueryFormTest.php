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
        
        
        $form
                ->expects($this->once())
                ->method('getErrors')
                ->will($this->returnValue(array('field1' => array('an error occured'))))
        ;
        $form
                ->expects($this->once())
                ->method('all')
                ->will($this->returnValue(array()))
        ;

        $object = new \Alterway\Bundle\RestProblemBundle\Problem\InvalidQueryForm($form);
        $expected = array('field1' => array('an error occured'));
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
        $expected = array();
        $this->assertEquals($expected, $object->getDetail());
    }

}
