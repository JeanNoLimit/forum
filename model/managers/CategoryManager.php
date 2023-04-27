<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\CategoryManager;

class CategoryManager extends Manager {

    protected $className="model\Entities\Category";
    protected $tableName="category";

    public function __construct(){
        parrent::connect();

    }




}
















?>