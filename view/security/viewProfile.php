<?php
$user = $result["data"]["user"];
// var_dump($user);die;
?>

<div class=ProfilContainer>
    <div class="title">
            <h1>Informations du profil</h1>
        </div>

        <div id="borderContainer">
            <p>Pseudo : <?= $user->getPseudo() ?></p>
            <p>Adresse Mail : <?= $user->getEmail()?></p>
            <p>Date de création du compte : le <?= $user->getinscriptionDate()->format("d-m-Y")?></p>
            <p>Nombre de posts : <?= $user->getNbPosts()?> </p>
            <p>Nombre de Topics créé : <?= $user->getNbTopics()?> </p>
        </div>
</div>