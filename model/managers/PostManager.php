<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\managers\PostManager;

class PostManager extends Manager {

    protected $classname = "Model\Entities\Post";
    protected $tablename = "post";


    public function __construct(){
        parent::connect();
    }
    

}









?>