<?php

namespace Alterway\Bundle\RestProblemBundle\Problem;

class Exception extends Problem
{

    public function __construct(\Exception $exception)
    {
        $this->problemType = "/exception";
        $this->title = $exception->getMessage();
        $this->detail = $exception->getMessage();
        $this->httpStatus = 500;

        if ($exception instanceof \LogicException) {
            $this->httpStatus = 400;
        }
    }
}
