<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;
// use Model\Managers\CategoryManager;

class CategoryManager extends Manager {

    protected $className = "Model\Entities\Category";
    protected $tableName = "category";

    public function __construct(){
        parent::connect();
    }

    // Requête permettant de compter le nombre de topics de chaque catégorie

    public function findAllCategories($order){
        $orderQuery = ($order) ?                 
            "ORDER BY ".$order[0]. " ".$order[1] :
            "";

        $sql = "SELECT *, (SELECT COUNT(*)
        FROM topic t
        WHERE t.category_id=c.id_category) AS nbTopics
        FROM category c            
                ".$orderQuery;

        return $this->getMultipleResults(
            DAO::select($sql), 
            $this->className
        );

    }



}
















?>