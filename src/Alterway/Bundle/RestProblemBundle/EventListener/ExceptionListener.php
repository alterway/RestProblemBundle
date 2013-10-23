<?php


namespace Alterway\Bundle\RestProblemBundle\EventListener;


use Alterway\Bundle\RestProblemBundle\Problem\Exception;
use Alterway\Bundle\RestProblemBundle\Response\ProblemResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    private $debugMode;

    public function __construct($debugMode)
    {
        $this->debugMode = $debugMode;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $event->setResponse(new ProblemResponse(new Exception($event->getException(), $this->debugMode)));
    }
}
