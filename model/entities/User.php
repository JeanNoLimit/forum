<?php

    namespace Model\entities;
    use App\Entities;

    // Chaque Entity hérite de la classe Entity (du dossier App et auront le même constructeur qui implémente la méthode "hydrate" de la classe Entity)
    final class User extends Entity {

        private int $id;
        private string $pseudo;
        private string $password;
        private DateTime $dateInscription;
        private string $role;

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
        public function getDateInscription()
        {
                return $this->dateInscription;
        }

        /**
         * Set the value of dateInscription
         *
         * @return  self
         */ 
        public function setDateInscription($dateInscription)
        {
                $this->dateInscription = $dateInscription;

                return $this;
        }

        /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
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
    }