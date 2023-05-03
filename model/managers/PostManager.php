<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;
// use Model\managers\PostManager;

class PostManager extends Manager {

    protected $className = "Model\Entities\Post";
    protected $tableName = "post";


    public function __construct(){
        parent::connect();
    }
    
        // Requête pour trouver tous les posts d'un topic
        public function findPostByTopic($id) {
            
            $sql = "SELECT *
                    FROM ".$this->tableName." p
                    WHERE p.topic_id= :id";
                    //La requête renvoie plusieurs objets, d'où getMultipleResults
            return $this->getMultipleResults(
                DAO::select($sql, ['id'=> $id]),
                $this->className
            );  
        }

        // Requête pour trouver le post le plus vieux d'un topic
        public function findFirstPost($id) {

            $sql = "SELECT id_post
                    FROM post p
                    WHERE p.topic_id= :id AND p.creationDate<=ALL(
                        SELECT p.creationDate
                        FROM post p
                        WHERE topic_id= :id)";
            return $this->getSingleScalarResult(DAO::select($sql, ['id' => $id]));


        }
        
}









?>