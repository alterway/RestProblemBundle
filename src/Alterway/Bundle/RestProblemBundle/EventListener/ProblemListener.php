<?php

namespace Alterway\Bundle\RestProblemBundle\EventListener;

use Alterway\Bundle\RestHalBundle\Response\ProblemResponse;
use Alterway\Bundle\RestProblemBundle\Problem\ProblemInterface;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ProblemListener
{

    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Guesses the template name to render and its variables and adds them to
     * the request object.
     *
     * @param FilterControllerEvent $event A FilterControllerEvent instance
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        return;
//        $controller = $event->getController();
//
//        if (!is_array($controller)) {
//            return;
//        }
//        list($object, $method) = $controller;
//
//        if ('json' !== $event->getRequest()->attributes->get('_format')) {
//            return;
//        }
//
//        $className = ClassUtils::getClass($object);
//        class_exists('\Alterway\Bundle\RestHalBundle\Controller\Annotations\Hal');
//        $reflectionClass = new ReflectionClass($className);
//        $reflectionMethod = $reflectionClass->getMethod($method);
//        $allAnnotations = $this->reader->getMethodAnnotations($reflectionMethod);
//
//        $halAnnotations = array_filter($allAnnotations, function($annotation) {
//                    return $annotation instanceof Hal
//                    ;
//                }
//        );
//
//        foreach ($halAnnotations as $annotation) {
//            $event->getRequest()->attributes->set('hal.rest', true);
//            $event->getRequest()->attributes->set('hal.type', $annotation->type);
//            $event->getRequest()->attributes->set('hal.code', $annotation->code);
//        }
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {

        $request = $event->getRequest();
        $resource = $event->getControllerResult();

        if ($request->getRequestFormat() != 'json') {
            return;
        }
        if (!$resource instanceof ProblemInterface) {
            return;
        }

        $headers = array('Content-type' => 'application/api-problem+json');
        $response = new ProblemResponse($resource);
        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => array('onKernelController', -128),
            KernelEvents::VIEW => 'onKernelView'
        );
    }

}