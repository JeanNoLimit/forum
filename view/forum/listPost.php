<?php
$posts = $result["data"]["posts"];
$topic = $result["data"]["topic"];
// Alternative possible en utilisant la fonction current()
// $topicName = $posts->current()->getTopic()->getTitle();
// $topicName=$topic->getTitle();
// echo $topicName;
?>

<div id="postTitle">
    <h1><?=$topic->getTitle()?></h1>
    <p class="creationDate">date de création : le <?=$topic->getCreationDate()->format("d-m-Y")?></p>
</div>
<div id="borderPost">
<div class="button newPost">
        <a href="">Nouveau message</a>
    </div>

<?php
foreach($posts as $post){ ?>

    <div class="messageContainer">
        <div class="userInformations">
            <p><?=$post->getUser()->getPseudo()?></p>
            <p class="inscriptionDate">date d'inscription : <br><?=$post->getUser()->getinscriptionDate()?></p>
        </div>

        <div class="messageContent">
            <h3><?=$post->getTopic()->getTitle()?></h3>
            <p class="content"><?=$post->getText()?></p>
            <p class="creationDate">message crée le <?=$post->getCreationDate()->format("d m Y")?></p>
        </div>
    </div>

<?php } ?>

</div>

