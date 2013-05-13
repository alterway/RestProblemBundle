<?php

namespace Alterway\Bundle\RestProblemBundle\Problem;

class InvalidQuery extends Problem
{

    public function __construct(array $errors = array())
    {
        parent::__construct();
        $this->uri = "/query/invalid";
        $this->title = "Invalid query";
        $this->details = implode(PHP_EOL, $errors);
        $this->httpStatus = 400;
    }

}
