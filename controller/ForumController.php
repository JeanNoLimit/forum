<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

         /********************************* Méthodes de gestions des Topics ********************************************************/



         /************************************************* VUE list TOPICS ***********************************************************/
       
         //affichage de la page index -> affichera la liste des topics triés par date de création décroissante
        public function index(){
            if(!Session::getUser()){
                $this-> redirectTo("security","signin");
            }else{
                // $this->redirectTo("forum", "listTopics", "1"); //pour faire une redirection
                $topicManager = new TopicManager();
                $postManager = new PostManager();



                return [
                    "view" => VIEW_DIR."forum/listTopics.php",
                    "data" => [
                        "topics" => $topicManager->findAllTopics(["creationDate", "DESC"])
                    ]
                ];
            }
        }
        

        /*************************************************************Suppression d'un TOPIC****************************************************/ 

        public function deleteTopic($id){
            //Seul les modérateur et les administrateurs peuvent supprimer un topic
            if(Session::getUser()->hasRole("MODERATOR") || Session::getUser()->hasRole("ROLE_ADMIN")){
                $topicManager = new TopicManager();
                $postManager = new PostManager();

                //Suppression d'un topic. Il faut d'abord supprimer les posts contenu dans le topic
                
                $posts= $postManager->findPostByTopic($id);
            
                foreach ($posts as $post){
                    $idPost=$post->getId();
                    $postManager->delete($idPost);
                }
                $topicManager->delete($id);
                

                return [
                    "view" => VIEW_DIR."forum/listTopics.php",
                    "data" => [
                        "topics" => $topicManager->findAllTopics(["creationDate", "DESC"])
                    ]
                ];
            }
        }
        /*********************************************** VUE formulaire Nouveau TOPIC ***********************************************************/
       
        //Affiche la page nouveau topic et gère la réception du formulaire
        public function newTopic(){
            if(!Session::getUser()){
                $this-> redirectTo("security","signin");
            }else{
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
                        $topicData=["title"=> $titleTopic, "user_id" =>Session::getUser()->getId(), "category_id" => $category_id];
                        //On ajoute les données à la table topic
                        // Et On récupère le dernier identifiant créer pour connaître l'id du topic
                        $id=$topicManager->add($topicData);
                        //Création du tableau $postData pour créer le premier post du nouveau sujet
                        $postData=["user_id"=>Session::getUser()->getId(), "topic_id"=> $id, "text"=> $message]; 
                        //On ajoute les données à la table post
                        $postManager->add($postData);

                        //  addFlash permet d'afficher un message en haut de l'écran, lors de l'ajout du post.
                        Session::addFlash("success", "Nouveau topic créé");
                    }
                }

                return [
                    "view" => VIEW_DIR."forum/newTopic.php",
                    "data" => [
                        "categories" => $categoryManager->findAll(["categoryName","ASC"])
                    ]

                ];
            }
        }

        //**********************************************Vérouillage/dévérouillage d'un topic ******************************************//

        public function switchLock($id){
            if(Session::getUser()->hasRole("MODERATOR") || Session::getUser()->hasRole("ROLE_ADMIN")){
                $topicManager = new TopicManager();
                
                $statut=$topicManager->findOneById($id)->getClosed();
                // var_dump($statut);die;

                switch ($statut) {

                    case false:

                        $statut=1;
                        $topicManager->changeStatut($id,$statut);
                        Session::addFlash("success", "Le topic est fermé");
                        break;

                    case true:
                    
                        $statut=0;
                        $topicManager->changeStatut($id,$statut);
                        // var_dump($statut);die;
                        Session::addFlash("success", "Le topic est réouvert");
                        break;
                }
                $this->redirectTo("forum","listTopics");
            }else{
                Session::addFlash("error", "Vous n'avez pas les droits pour clôturer un topic.");
                $this->redirectTo("forum","listTopics");
            }
        }
                    
    
        /******************************************************Méthodes de gestions des posts********************************************************/

       
        /**************************************** VUE Affichage des posts + formulaire Nouveau post ***********************************************************/
        // Pour l'affichage de la vue des post d'un topic. 
        public function listPosts($id){
            if(!Session::getUser()){
                $this-> redirectTo("security","signin");
            }else{
                $topicManager = new TopicManager();
                $postManager = new PostManager();
                $closed=$topicManager->findOneById($id)->getClosed();
                

                //************ Insertion d'un nouveau message*************//
                if (isset($_POST['messageSubmit'])){
                    
                    // On filtre le message
                    $message=filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);
                    //On créer le tableau de data qui sera utilisé par la fonction add du Manager.
                    //On attribue un user_id de base car la connection et l'authentification des utilisateurs n'est pas encore gérée.
                    $data = ["user_id"=> Session::getUser()->getId(), "topic_id"=> $id, "text"=> $message];
                    //On récupère la condition "closed" de topic pour vérifier si le topic est bloqué ou non
                    //On vérifie que le topic n'est pas fermé.
                    if($closed==false){
                        if($message){
                            $postManager->add($data) ;
                            //  addFlash permet d'afficher un message en haut de l'écran, lors de l'ajout du post.
                            Session::addFlash("success", "message ajouté");
                        }
                    }else{
                        Session::addFlash("error", "Le Topic est fermé, vous vous pouvez plus poster de nouveau message");
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
        }

        //*************************** Suppresion d'un message! **************************//

        public function deletePost($id){

            $topicManager=new TopicManager();
            $postManager= new PostManager();
            //Sont autorisés à supprimer un post : L'auteur du post, les modérateurs, les admins.
            //On récupère l'id de l'user en session pour le comparer avec l'user_id du post.
            $id_user= Session::getUser()->getId();
            $user_id=$postManager->findOneById($id)->getUser()->getId();
           
            //On récupère l'id du topic
            $id_topic=$postManager->findOneById($id)->getTopic()->getId();
            // On récupère l'identifiant du premier post du topic
            $firstPost=$postManager->findFirstPost($id_topic);

            if($id_user==$user_id||Session::getUser()->hasRole("MODERATOR") || Session::getUser()->hasRole("ROLE_ADMIN")){
 
                if($id==$firstPost["id_post"]){
                    //  addFlash permet d'afficher un message en haut de l'écran, lors de l'ajout du post.
                    Session::addFlash("error", "impossible de supprimer le message!");
                }else{
                    $postManager->delete($id);
                
                        Session::addFlash("success", "message supprimé");
                }
            }else{
                Session::addFlash("error", "impossible de supprimer le message!");
            }


            return [
                "view" => VIEW_DIR."forum/listPost.php",
                "data" => [
                    "posts" => $postManager->findPostByTopic($id_topic),
                    "topic" => $topicManager->findOneById($id_topic)
                ]
            ];
        }
        




         /******************************************************Méthodes de gestions des catégories********************************************************/



        /**************************************** VUE Affichage liste catégories ***********************************************************/

        //Pour gestion de la vue de la liste des catégories
        public function listCategory(){

            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listCategory.php",
                "data" => [
                    "categories" => $categoryManager->findAllCategories(["categoryName","ASC"])
                ]

            ];

        }

        /**************************************** VUE formulaire nouvelle catégorie***********************************************************/

        // Pour la gestion de la vue formulaire nouvelle catégorie

        public function newCategory(){

            $categoryManager = new CategoryManager();

            if(isset($_POST["submitNewCategory"])){

                $categoryName=filter_input(INPUT_POST,"categoryName",  FILTER_SANITIZE_SPECIAL_CHARS);


                if($categoryName){
                    $data=['categoryName' =>$categoryName];
                    $categoryManager -> add($data);

                    //  addFlash permet d'afficher un message en haut de l'écran, lors de l'ajout du post.
                    Session::addFlash("success", "Nouvelle catégorie ajoutée");

                }
            }


            return[
                "view" => VIEW_DIR."forum/newCategory.php"
            ];
        }


        /**************************************** VUE Affichage des topics d'une catégorie***********************************************************/

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
