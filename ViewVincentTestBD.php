<?php


echo '<div class="container black">
        <form id="register" method="post" action="ControllerVincentTestBD.php">
            
                    <label name="idDis">Id Discussion a qui appartent le msg</label>
            <input name="idDis" type="text" required>
            
                        <label name="Message">Message</label>
            <input name="Message" type="text" required>
            
                        <label name="stateMsg">Etat</label>
            <input name="stateMsg" type="text" required>
            
            <label name="author">Auteur</label>
            <input name="author" type="text" required>
            
            <button type="submit" value="Envoyer">Envoyer</button>
        </form>
    </div>';
