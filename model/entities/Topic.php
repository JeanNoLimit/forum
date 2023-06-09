<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private int $id;
        private string $title;
        private \DateTime $creationDate;
        private bool $closed;
        private User $user;
        private Category $category;
        private int $nbPosts;
        private \Datetime $lastPost;

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
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        /**
         * Get the value of creationDate
         */ 
        public function getCreationDate()
        {
                return $this->creationDate;
        }

        /**
         * Set the value of creationDate
         *
         * @return  self
         */ 
        public function setCreationDate($creationDate)
        {
                $this->creationDate = new \DateTime ($creationDate);

                return $this;
        }

        /**
         * Get the value of closed
         */ 
        public function getClosed()
        {
                return $this->closed;
        }

        /**
         * Set the value of closed
         *
         * @return  self
         */ 
        public function setClosed($closed)
        {
                $this->closed = $closed;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;

                return $this;
        }

        /**
         * Get the value of category
         */ 
        public function getCategory()
        {
                return $this->category;
        }

        /**
         * Set the value of category
         *
         * @return  self
         */ 
        public function setCategory($category)
        {
                $this->category = $category;

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
         * Get the value of lastPost
         */ 
        public function getLastPost()
        {
                return $this->lastPost;
        }

        /**
         * Set the value of lastPost
         *
         * @return  self
         */ 
        public function setLastPost($lastPost)
        {
                $this->lastPost = new \DateTime ($lastPost);

                return $this;
        }
    }
