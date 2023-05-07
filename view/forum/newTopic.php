<?php
$categories = $result["data"]["categories"];

?>


<div class="title">
    <h1>Nouveau sujet</h1>
</div>

<div id="borderContainer">

   <form action="index.php?ctrl=forum&action=newTopic" method="post">

    <div>
        <label for="titleTopic"> Titre du sujet 
            <input type="text" name="titleTopic" id="titleTopic">
        </label>
    </div>

    <div>
        <label for="category"> Catégorie
            <select name="category_id" id="category">
                <?php foreach($categories as $category) { ?>
                    <option value="<?= $category->getId(); ?>"><?= $category->getCategoryName();?></option>
                <?php } ?>    
            </select>
        </label>
    </div>
                    <p>Si la catégorie n'est pas présente dans la liste, veuillez <a href="index.php?ctrl=forum&action=newCategory">cliquer ici </a></p>
    <div>
        <label for="message">Message 
            <textarea name="message" id="message" cols="80" rows="10"></textarea>
        </label>
    </div>

    <div>
        <input type="submit" value="Envoyer" name="submitNewTopic">
    </div>
    





   </form> 




</div>