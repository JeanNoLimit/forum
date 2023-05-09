<?php

$users = $result["data"]["users"];

?>


<div id="generalContainer">

    <div class="title">
        <h1>liste des utilisateurs</h1>
    </div>


    <?php
        foreach($users as $user){ ?>

            <div class="listContainer">
                <div class="leftListContainer">
                    <h2><?= $user->getPseudo() ?></h2>
                </div>
                <div class="rightListContainer">
                </div>
            </div>  

    <?php } ?>

</div>
