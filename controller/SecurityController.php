<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

class SecurityController extends AbstractController implements ControllerInterface{

    public function index(){}

    
    public function signup(){

        return [
            "view" => VIEW_DIR."security/register.html"
        ];
    }

    public function signin(){

        return [
            "view" => VIEW_DIR."security/login.html"
        ];
    }




    public function register(){

        $userManager=new UserManager();

        if(isset($_POST["submitRegistration"])){
            
            $pseudo=filter_input(INPUT_POST, "pseudo",  FILTER_SANITIZE_SPECIAL_CHARS);
            $email=filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL); //Puis vérifier que l'adresse mail a une forme valide  :(filter_var($email, FILTER_VALIDATE_EMAIL)) 
            $password=filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS );
            $password2=filter_input(INPUT_POST,"checkPassword",FILTER_SANITIZE_SPECIAL_CHARS);
        
            if($pseudo && $email && $password && $password2){
                
                //On vérifie l'existance du pseudo et de l'adresse mail dans la bdd
                
                if($userManager->findEmail($email)){
                    Session::addFlash("error", "adresse mail déja utiliséé");
                    $this->redirectTo("security","signup");
                }elseif($pseudoBdd=$userManager->findPseudo($pseudo)){
                    Session::addFlash("error", "Pseudo déja utilisé, veuillez entrer un pseudo valide");
                    $this->redirectTo("security","signup");
                    //rappel : strcmp -> comparaison binaire de chaînes. La comparaison est sensible à la casse.
                }elseif(strcmp($password, $password2) !==0){
                    Session::addFlash("error", "Les mots de passe ne correspondent pas");
                    $this->redirectTo("security","signup");
                }else {
                    $password=password_hash($password,PASSWORD_DEFAULT);
                    //Rôle par défaut -> USER
                    $data=["email" => $email, "pseudo" => $pseudo, "password" => $password, "role" => "USER"];
                  
                    $userManager->add($data);

                    Session::addFlash("success", "Incription réussie!");

                     // Si l'inscription c'est bien passé :
                    $this-> redirectTo("security","signin");

                }

            }
        }
       
  
    }


    public function login() {

        $userManager= new UserManager;
    
        if(isset($_POST['submitLogin'])){

            $email=filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL );
            $password=filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

            if($email && $password){

                $user=$userManager->findEmail($email);
                // var_dump($user);die;

                if(!$user){
                    Session::addFlash("error", "Veuillez rentrer une adresse valide");
                    $this-> redirectTo("security","signin");
                }elseif(password_verify($password, $user->getPassword())==false){
                    Session::addFlash("error", "Mot de passe incorrect");
                    $this-> redirectTo("security","signin");
                }else{
                    //var_dump($user->getRole());die;
                    Session::setUser($user);
                    
                    $this->redirectTo("forum","index"); //Penser à rediriger vers home lorsque cela sera possible.
                }
            }  


        }
        
    }







}
?>