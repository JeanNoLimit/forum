<?php

$users = $result["data"]["users"];

?>


<div id="generalContainer">

    <div class="title">
        <h1>liste des utilisateurs</h1>
    </div>


    <?php
        foreach($users as $user){
           ?>
         
            <div class="listContainer">
                <div class="leftListContainer">
                    <h2><?= $user->getPseudo() ?></h2>
                    <p>date d'inscription : <?=$user->getinscriptionDate()->format("d-m-Y")?></p>
                    <p>role : <?=$user->getRole()?></p>
                </div>
                <div class="rightListContainer">
                    <form action="index.php?ctrl=security&action=switchRole&id=<?=$user->getId()?>" method="post">
                    <p>Modifier le rôle :</p>
                    <div class=changeRole>

                        <?php


                            $roles=["USER","MODERATOR","ROLE_ADMIN","BANNED"];
                            foreach($roles as $role){?>
                                <div>
                                    <input type="radio" id="role" name="role" value="<?=$role?>" <?php if($user->getRole()==$role){  echo "checked"; }; ?> > 
                                    <label for="role"><?=$role?></label>
                                </div>

                        <?php } ?>
                        
                    </div>
                        <input type="submit" value="Envoyer" name="submitNewRole" class="submitButton">
                    </form>
                </div>
            </div>  

    <?php } ?>

</div>
