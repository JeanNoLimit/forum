<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


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
        
        //Requête pour afficher les topics d'une catégorie?
        public function findTopicsByCategory($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." p
                    WHERE p.category_id= :id";
            return $this->getMultipleResults(
                DAO::select($sql, ['id'=> $id]),
                $this->className
            );
        }




    }