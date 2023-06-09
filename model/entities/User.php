<?php

    namespace Model\entities;
    use App\Entity;

    // Chaque Entity hérite de la classe Entity (du dossier App et auront le même constructeur qui implémente la méthode "hydrate" de la classe Entity)
    final class User extends Entity {

        private int $id;
        private string $email;
        private string $pseudo;
        private string $password;
        private \DateTime $inscriptionDate;
        private string $role;
        private int $nbPosts;
        private int $nbTopics;

        public function __construct($data){
            $this->hydrate($data);
        }

        



        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of pseudo
         */ 
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of pseudo
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        /**
         * Get the value of dateInscription
         */ 
        public function getinscriptionDate()
        {
                return $this->inscriptionDate;
        }

        /**
         * Set the value of dateInscription
         *
         * @return  self
         */ 
        public function setinscriptionDate($inscriptionDate)
        {
                $this->inscriptionDate = new \DateTime ($inscriptionDate);

                return $this;
        }

        /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
        }


        public function hasRole($role){
                if($this->getRole()==$role){
                  return true;      
                }
                return false;     
        }
        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of nbPosts
         */ 
        public function getNbPosts()
        {
                return $this->nbPosts;
        }

        /**
         * Set the value of nbPosts
         *
         * @return  self
         */ 
        public function setNbPosts($nbPosts)
        {
                $this->nbPosts = $nbPosts;

                return $this;
        }

        /**
         * Get the value of nbTopics
         */ 
        public function getNbTopics()
        {
                return $this->nbTopics;
        }

        /**
         * Set the value of nbTopics
         *
         * @return  self
         */ 
        public function setNbTopics($nbTopics)
        {
                $this->nbTopics = $nbTopics;

                return $this;
        } 
        
        public function __toString(){
                return $this->pseudo;
        }
    }