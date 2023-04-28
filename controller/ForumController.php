<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    
    class ForumController extends AbstractController implements ControllerInterface{


        //affichage de la page index -> affichera la liste des topics triés par date de création décroissante
        public function index(){
          
            // $this->redirectTo("forum", "listTopics", "1"); //pour faire une redirection
           $topicManager = new TopicManager();
            // var_dump($topicManager);die;
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["creationDate", "DESC"])
                ]
            ];
        
        }


        // Pour l'affichage de la vue des post d'un topic. 
        public function listPosts($id){
            $postManager = new PostManager();
            if (isset($_POST['submit'])){

                // ajout en BDD 
            }

            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listPost.php",
                "data" => [
                    "posts" => $postManager->findPostByTopic($id),
                    "topic" => $topicManager->findOneById($id)
                ]
            ];
        }

        //Pour gestion de la vue de la liste des catégories
        public function listCategory(){

            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listCategory.php",
                "data" => [
                    "categories" => $categoryManager->findAll(["categoryName","ASC"])
                ]

            ];

        }

        //Pour la gestion de la vue liste des topics d'une catégorie.
        public function listTopicsByCategory($id){

            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();

            return [
                "view" =>VIEW_DIR."forum/listTopicsByCategory.php",
                "data" => [
                    "topics" => $topicManager->findTopicsByCategory($id),
                    "category"=> $categoryManager->findOneById($id)
                ]
            ];
        }
            // $idLastpost = $Postrepo->add($data);
        

    }
