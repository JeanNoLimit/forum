<?php
$categories = $result["data"]["categories"];

?>

<div class="formContainerTopic">
    <div class="title">
        <h1>Nouveau sujet</h1>
    </div>

    <div id="borderContainer">

    <form action="index.php?ctrl=forum&action=newTopic" method="post" class="formTopicAndCat ">

        <div>
            <label for="titleTopic"> Titre du sujet 
                <input type="text" name="titleTopic" id="titleTopic" class="inputField newTitle">
            </label>
        </div>

        <div>
            <label for="category"> Catégorie
                <select name="category_id" id="category" class="inputField">
                    <?php foreach($categories as $category) { ?>
                        <option value="<?= $category->getId(); ?>"><?= $category->getCategoryName();?></option>
                    <?php } ?>    
                </select>
            </label>
            <p class="newCatLink">Si la catégorie n'est pas présente dans la liste, veuillez <a href="index.php?ctrl=forum&action=newCategory">cliquer ici </a></p>
        </div>
                        
        <div>
            <label for="message">Message  </label>
                <textarea name="message" id="message" cols="80" rows="10" class=TopicTextArea></textarea>
        
        </div>


            <input type="submit" value="Envoyer" name="submitNewTopic" class="submitButton">

        
    </form> 




    </div>
</div>