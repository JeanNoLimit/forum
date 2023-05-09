<?php

namespace Model\Managers;

use App\Manager;
use App\DAO;
// use Model\Managers\UserManager;



class UserManager extends Manager{

    protected $className="Model\Entities\User";
    protected $tableName="user";


    public function __construct(){
        parent::connect();

    }

    //Requête pour vérifie l'existence de l'adresse mail dans la bdd
    public function findEmail($email){

        $sql="SELECT *
            FROM ".$this->tableName."
            WHERE email LIKE :email";

        return $this->getOneOrNullResult(
            DAO::select($sql,['email' => $email], false), $this->className
        );
    }
    //Requête pour vérifier l'existence de pseudo dans la bdd
    public function findPseudo($pseudo){
        $sql="SELECT *
            FROM ".$this->tableName."
            WHERE pseudo LIKE :pseudo";

        return $this->getOneOrNullResult(
            DAO::select($sql,['pseudo' => $pseudo],false), $this->className
        );
        
    }
    //Requête qui remplace findOneById pour afficher le nombre de posts et le nombre de topic créé par l'utilisateur dans la vue viewProfil
    public function findProfil($id){

        $sql = "SELECT *, (SELECT COUNT(*) 
        FROM post
        WHERE user_id= :id)
        AS nbPosts, (SELECT COUNT(*)
        FROM topic
        WHERE user_id= :id) AS nbTopics
        FROM user
        WHERE id_user= :id";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
    }



}