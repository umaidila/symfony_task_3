<?php

namespace  App\Service;

class CheckHealthService{

    private $status;

    public  function __construct($status){
        $this->status = $status;
    }

    public function env(){
        return $this->status;
    }
}
