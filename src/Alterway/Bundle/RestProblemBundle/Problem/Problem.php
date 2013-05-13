<?php

namespace Alterway\Bundle\RestProblemBundle\Problem;

class Problem implements ProblemInterface
{

    protected $problemType = 'http://not-specified-yet';
    protected $title;
    protected $detail;
    protected $httpStatus;

    public function getProblemType()
    {
        return $this->problemType;
    }

    public function setProblemType($problemType)
    {
        $this->problemType = $problemType;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getDetail()
    {
        return $this->detail;
    }

    public function setDetail($detail)
    {
        $this->detail = $detail;
        return $this;
    }
    
    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

    public function setHttpStatus($httpStatus)
    {
        $this->httpStatus = $httpStatus;
        return $this;
    }



}
