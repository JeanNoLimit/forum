<?php
$posts = $result["data"]["posts"];
$topic = $result["data"]["topic"];
// Alternative possible en utilisant la fonction current()
// $topicName = $posts->current()->getTopic()->getTitle();
// $topicName=$topic->getTitle();
// echo $topicName;
?>
                                        <!-- Affichage des posts -->
<div id="title">
    <div id="LeftTitle">
        <h1><?=$topic->getTitle()?></h1>
        <p class="additionnalContent">date de création : le <?=$topic->getCreationDate()->format("d-m-Y à h:i")?></p>
    </div id="rightTitle">
    <div class="button closedButton">
        <a href="index.php?ctrl=forum&action=switchLock&id=<?=$topic->getId()?>">Vérouiller Topic</a>
    </div>
</div>
<div id="borderPost">
<div class="button newPost">
        <a href="#newMessage">Nouveau message</a>
    </div>

<?php
foreach($posts as $post){ ?>

    <div class="messageContainer">
        <div class="userInformations">
            <p><?=$post->getUser()->getPseudo()?></p>
            <p class="inscriptionDate">date d'inscription : <br><?=$post->getUser()->getinscriptionDate()->format("d-m-Y")?></p>
        </div>

        <div class="messageContent">

            <h3><?=$post->getTopic()->getTitle()?></h3>
            <p class="content"><?=$post->getText()?></p>

            <div class="additionnalContent">
                <p>message crée le <?=$post->getCreationDate()->format("d-m-Y à h:i")?> - </p>
                <p><a href="index.php?ctrl=forum&action=listPosts&id=<?=$post->getTopic()->getId()?>&deletePost&idPost=<?=$post->getId()?>"> Supprimer</a></p>
            </div>
        </div>
    </div>

<?php } ?>
</div>
                                        <!-- Formulaire de saisie d'un nouveau post -->
<?php if($topic->getClosed()){ ?>

    <div id="title">
        <h3>Nouveau message</h3>
    </div>
    <div id="borderPost">

    <p> Le topic est fermé!</p>

    </div>

<?php } else { ?>

    <div id="title">
        <h3>Nouveau message</h3>
    </div>
    <div id="borderPost">

        <form action="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>" method="post">
            <div id="newMessage">
                <label for="message">message</label>
                    <textarea name="message" id="message" cols="80" rows="10"></textarea>
            </div>
            <input type="submit" value="Envoyer" name="messageSubmit">
        </form>

    </div>

<?php } ?>