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
                
                if(!$userManager->findEmail($email)){
                    if(strlen($email)>=10 && strlen($email)<=50){
                        if(!$userManager->findpseudo($pseudo)){
                            if(strlen($pseudo)>=4 && strlen($pseudo)<=20){
                                //rappel : strcmp -> comparaison binaire de chaînes. La comparaison est sensible à la casse.
                                if(strcmp($password, $password2) ==0){
                                    if(strlen($password)>=4 && strlen($password)<=16){
                                         // Si l'inscription c'est bien passée :
                                        $password=password_hash($password,PASSWORD_DEFAULT);
                                        //Rôle par défaut -> USER
                                        $data=["email" => $email, "pseudo" => $pseudo, "password" => $password, "role" => "USER"];
                                        $userManager->add($data);
                                       
                                        Session::addFlash("success", "Incription réussie!");
                                        $this-> redirectTo("security","signin");
                                    }else{
                                        Session::addFlash("error", "Le mot de passe doit contenir entre 4 et 16 caractères");
                                        $this->redirectTo("security","signup");
                                    }
                                }else{
                                    Session::addFlash("error", "Les mots de passe ne correspondent pas");
                                    $this->redirectTo("security","signup");
                                }
                            }else{
                                Session::addFlash("error", "Le pseudo doit contenir entre 4 et 20 caractères");
                                $this->redirectTo("security","signup");
                            }
                        }else{
                            Session::addFlash("error", "Pseudo déja utilisé. Veuillez entrer un pseudo valide");
                            $this->redirectTo("security","signup");
                        }
                    }else{
                        Session::addFlash("error", "Veuillez entrer une adresse valide");
                        $this->redirectTo("security","signup");
                    }
                }else{
                    Session::addFlash("error", "Adresse mail déja utilisée");
                    $this->redirectTo("security","signup");
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

                if($user){
                    if(password_verify($password, $user->getPassword())){
                        if(!$user->hasRole("BANNED")){
                            Session::setUser($user);
                            $this->redirectTo("forum","index"); //Penser à rediriger vers home lorsque cela sera possible.
                        }else{
                            Session::addFlash("error", "Vous avez été banni, veuillez contacter l'admin du forum pour plus d'informations");
                            $this-> redirectTo("security","signin");
                        }

                    }else{
                        Session::addFlash("error", "Mot de passe incorrect");
                        $this-> redirectTo("security","signin");
                    }
                }else{
                    Session::addFlash("error", "Veuillez rentrer une adresse valide");
                    $this-> redirectTo("security","signin");
                }

            }  


        }
        
    }


//Gestion de la vue viewProfile de l'utilisateur connecté
public function viewProfile(){

    $userManager= new UserManager;
    $id=Session::getUser()->getId();
    return [
        "view" => VIEW_DIR."security/viewProfile.php",
        "data" => [ "user"=> $userManager ->findProfil($id)]
    ];
}



//Gestion de la deconnection
public function logout(){

    if(Session::getUser()){

        session_destroy();
        $this->redirectTo("index");

        // Session::addFlash("success", "vous avez été déconnecté");

    }

}

//changement de rôle dans la vue users. 

public function switchRole($id){

    if(Session::isAdmin()){

        $userManager = new UserManager();
        
            if(isset($_POST["submitNewRole"])){

                $role=filter_input(INPUT_POST, "role",  FILTER_SANITIZE_SPECIAL_CHARS);

                if($role){
                    $userManager->changeRole($id, $role);
                }
            }
        return [
            "view" => VIEW_DIR."security/users.php",
            "data" => [ "users" => $userManager->findAll(['inscriptionDate', 'DESC'])]
        ];
    }

}



}
?>