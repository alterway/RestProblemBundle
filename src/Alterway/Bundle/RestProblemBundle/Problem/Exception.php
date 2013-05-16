<?php

namespace Alterway\Bundle\RestProblemBundle\Problem;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class Exception extends Problem
{

    public function __construct(\Exception $exception)
    {
        $this->problemType = "/exception";
        $this->title = $exception->getMessage();
        $this->detail = $exception->getMessage();

        if ($exception instanceof HttpExceptionInterface) {
            $this->httpStatus = $exception->getStatusCode();
        } else {
            $this->httpStatus = 500;
        }
    }
}
