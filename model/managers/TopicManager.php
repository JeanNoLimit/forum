<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }


        //Requête pour afficher les topics d'une catégorie
        public function findTopicsByCategory($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." p
                    WHERE p.category_id= :id";
            return $this->getMultipleResults(
                DAO::select($sql, ['id'=> $id]),
                $this->className
            );
        }

        //Renplace la méthode findAll du manager pour ajouter un compteur nbPosts
        public function findAllTopics($order){
            $orderQuery = ($order) ?                 
                "ORDER BY ".$order[0]. " ".$order[1] :
                "";

            $sql = "SELECT *, (SELECT COUNT(*)
            FROM post p
            WHERE id_topic=p.topic_id) as nbPosts
            FROM topic t            
                    ".$orderQuery;

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

    }