<?php


namespace Alterway\Bundle\RestProblemBundle\EventListener;


use Alterway\Bundle\RestProblemBundle\Problem\Exception;
use Alterway\Bundle\RestProblemBundle\Response\ProblemResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $problem = new Exception($exception);

        $event->setResponse(new ProblemResponse($problem));
    }
}