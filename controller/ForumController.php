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

        //Affiche la page nouveau topic et gère la réception du formulaire
        public function newTopic(){

            //Instanciation des classes nécessaires à l'insertion des données du formulaire dans la bdd et à l'affichage du formulaire  
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $categoryManager = new CategoryManager();

            if (isset($_POST['submitNewTopic'])){
                
                //On filtre les données
                $titleTopic=filter_input(INPUT_POST, "titleTopic",  FILTER_SANITIZE_SPECIAL_CHARS);
                $category_id=filter_input(INPUT_POST, "category_id", FILTER_VALIDATE_INT);
                $message=filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);

                
                
               if($titleTopic && $category_id && $message) {

                    //Création du tableau $topicData pour insérer les données dans la table Topic
                    $topicData=["title"=> $titleTopic, "user_id" =>1, "category_id" => $category_id];
                    //On ajoute les données à la table topic
                    // Et On récupère le dernier identifiant créer pour connaître l'id du topic
                    $id=$topicManager->add($topicData);
                    //Création du tableau $postData pour créer le premier post du nouveau sujet
                    $postData=["user_id"=> 1, "topic_id"=> $id, "text"=> $message];
                    //On ajoute les données à la table post
                    $postManager->add($postData);
                }
            }

            return [
                "view" => VIEW_DIR."forum/newTopic.php",
                "data" => [
                    "categories" => $categoryManager->findAll(["categoryName","ASC"])
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
