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
            
                
                <label name="idMsg">Id Msg de base </label>
                <input name="idMsg" type="text" required><br/>
                
                <label name="MessageU">Message</label>
                <input name="MessageU" type="text" required><br/>
                
                <label name="authorU">Auteur</label>
                <input name="authorU" type="text"><br/>
                
                <label name="etatU">Etat </label>
                <input name="etatU" type="text"><br/>
                
                
                <button type="submit" value="Envoyer">MISE A JOUR</button><br/>
            </form>
        </div>';
