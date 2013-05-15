<?php

namespace Alterway\Bundle\RestProblemBundle\EventListener;

use Alterway\Bundle\RestProblemBundle\Problem\ProblemInterface;
use Alterway\Bundle\RestProblemBundle\Response\ProblemResponse;
use Doctrine\Common\Annotations\Reader;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/*
 * (c) 2013 La Ruche Qui Dit Oui!
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ProblemListener
{

    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }


    public function onKernelView(GetResponseForControllerResultEvent $event)
    {

        $request = $event->getRequest();
        $resource = $event->getControllerResult();
        
        if(null ===$request->get('_rest_problem')) {
            return;
        }
        if ($request->getRequestFormat() != 'json') {
            return;
        }
        if (!$resource instanceof ProblemInterface) {
            return;
        }

        $headers = array('Content-type' => 'application/api-problem+json');
        $response = new ProblemResponse($resource, 400, $headers);
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