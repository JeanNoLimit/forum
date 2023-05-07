<?php
$posts = $result["data"]["posts"];
$topic = $result["data"]["topic"];
// Alternative possible en utilisant la fonction current()
// $topicName = $posts->current()->getTopic()->getTitle();
// $topicName=$topic->getTitle();
// echo $topicName;
?>
                                        <!-- Affichage des posts -->
<div id="postContainer">
    <div class="title postTitle">
        <div class="LeftTitle">
            <h1><?=$topic->getTitle()?></h1>
            <p class="additionnalContent">date de création : le <?=$topic->getCreationDate()->format("d-m-Y à h:i")?></p>
        </div class="rightTitle">
        <?php if($topic->getClosed()){ ?>

        <div class="closedButton redButton">
            <a href="index.php?ctrl=forum&action=switchLock&id=<?=$topic->getId()?>">Topic fermé <i class="fa-solid fa-lock"></i> </a>
        </div>
        <?php }else { ?>
            <div class="closedButton greenButton">
            <a href="index.php?ctrl=forum&action=switchLock&id=<?=$topic->getId()?>">Topic ouvert <i class="fa-solid fa-unlock"></i></i></a>
        </div>
        <?php } ?>
    </div>
    <div id="borderContainer">
    <div class="button newPost">
            <a href="#newMessage">répondre <i class="fa-solid fa-reply"></i> </a>
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
                    <p><a href="index.php?ctrl=forum&action=listPosts&id=<?=$post->getTopic()->getId()?>&deletePost&idPost=<?=$post->getId()?>"> Supprimer </a></p>
                </div>
            </div>
        </div>

    <?php } ?>
    </div>
                                            <!-- Formulaire de saisie d'un nouveau post -->
    <?php if($topic->getClosed()){ ?>

        <div class="title formTitle">
            <h3>Nouveau message</h3>
        </div>
        <div id="borderContainer">

        <p> Le topic est fermé!</p>

        </div>
</div>
    <?php } else { ?>

        <div class="title formTitle">
            <h1>Nouveau message</h1>
        </div>
        <div id="borderContainer">
            <form action="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>" method="post" class="formPost">
                    <!-- <label for="message"></label> -->
                        <textarea name="message" id="message"></textarea>
                
                <input type="submit" value="Envoyer" name="messageSubmit" class=submitButton>
            </form>

        </div>

    <?php } ?>
</div>