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

            $sql = "SELECT *, (SELECT COUNT(*)
                    FROM post p
                    WHERE id_topic=p.topic_id) as nbPosts
                    FROM ".$this->tableName." p
                    WHERE p.category_id= :id
                    ORDER BY creationDate DESC";
            return $this->getMultipleResults(
                DAO::select($sql, ['id'=> $id]),
                $this->className
            );
        }

        //Remplace la méthode findAll du manager pour ajouter un compteur nbPosts
        public function findAllTopics($order){
            $orderQuery = ($order) ?                 
                "ORDER BY ".$order[0]. " ".$order[1] :
                "";

            $sql = "SELECT *, (SELECT COUNT(*)
                    FROM post p
                    WHERE id_topic=p.topic_id) as nbPosts, (SELECT p.creationDate
                    FROM post p
                    WHERE p.topic_id=t.id_topic AND p.id_post>=ALL(
                        SELECT id_post
                        FROM post
                        WHERE topic_id=t.id_topic)) AS lastPost
                    FROM topic t            
                    ".$orderQuery;

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        // Requête permettant la modification de la colonne closed d'un topic. (vérouillage topic)
        public function changeStatut($id,$statut){
            $sql="UPDATE ".$this->tableName."
                  SET closed= :statut
                  WHERE id_topic= :id";
            return $this->getOneOrNullResult(DAO::update($sql, ['statut'=> $statut, 'id'=>$id]),
            $this->className);
        }

    }