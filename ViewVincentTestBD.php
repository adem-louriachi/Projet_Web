<?php


echo '<div class="container black">
        <form id="register" method="post" action="ControllerVincentTestBD.php">
            
                    <label name="idDis">Id Discussion a qui appartent le msg</label>
            <input name="idDis" type="text" required><br/>
            
                        <label name="Message">Message</label>
            <input name="Message" type="text" required><br/>
            
            <label name="author">Auteur Inutile a taper pour l\'instant</label>
            <input name="author" type="text"><br/>
            
            <button type="submit" value="Envoyer">Envoyer</button><br/>
        </form>
    </div>';
