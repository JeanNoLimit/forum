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

             $topicManager = new TopicManager();
             $postManager = new PostManager();

            // Insertion d'un nouveau message
            if (isset($_POST['messageSubmit'])){
                
                // On filtre le message
                $message=filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);
                //On créer le tableau de data qui sera utilisé par la fonction add du Manager.
                //On attribue un user_id de base car la connection et l'authentification des utilisateurs n'est pas encore gérée.
                $data = ["user_id"=> 1, "topic_id"=> $id, "text"=> $message];

                if($message){
                    
                     $postManager->add($data) ;
                    //  addFlash permet d'afficher un message en haut de l'écran, lors de l'ajout du post.
                     Session::addFlash("success", "message ajouté");
                }
               
            }

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
