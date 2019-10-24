<?php


    echo '<div class="container black">
            <form id="register" method="post" action="ControllerVincentTestBD.php">
                <label>AJOUT D\'UN MESSAGE</label><br/>
            
                
                <label name="idDis">Id Discussion a qui appartent le msg</label>
                <input name="idDis" type="text" required><br/>
                
                <label name="Message">Message</label>
                <input name="Message" type="text" required><br/>
                
                <label name="author">Auteur</label>
                <input name="author" type="text"><br/>
                
                <button type="submit" value="Envoyer">Envoyer</button><br/>
            </form>
            
            <form id="register" method="post" action="ControllerVincentTestBD.php">
                <label>UPDATE UN MESSAGE</label><br/>
            
                
                <label name="idDis">Id Discussion a qui appartent le msg</label>
                <input name="idDis" type="text" required><br/>
                
                <label name="Message">Message</label>
                <input name="Message" type="text" required><br/>
                
                <label name="author">Auteur</label>
                <input name="author" type="text"><br/>
                
                <label name="author">Etat </label>
                <input name="author" type="text"><br/>
                
                
                <button type="submit" value="Envoyer">MISE A JOUR</button><br/>
            </form>
        </div>';
