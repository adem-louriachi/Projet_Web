<?php
    echo '<form id="GameTest" method="post" action="ControllerVincentTestBD.php">
            <button name="GameTestDB" type="submit" value="ChargeGameTest">Charger le jeu de test</button><br/>
          </form>';


echo '<div class="container black">
            <form id="register" method="post" action="ControllerVincentTestBD.php">
                <label>AJOUT D\'UNE DISCUSSION</label><br/>
            
                
                <label name="NomDisCreer">Nom de la discussion</label>
                <input name="NomDisCreer" type="text" required><br/>
                
                <label name="Createur">Createur</label>
                <input name="Createur" type="text" required><br/>
                
                <button  name="CreateDiscussion" type="submit" value="Envoyer">Creer Discussion</button><br/>
            </form>
            
            <form id="register" method="post" action="ControllerVincentTestBD.php">
                <label>FERMER UNE DISCUSSION</label><br/>
                        
                <label name="DisAFermer">Id de la discussion a fermer</label>
                <input name="DisAFermer" type="text" required><br/>
                
                <button  name="CloseDis" type="submit" value="Envoyer">Clore Discussion</button><br/>
            </form>
            <form id="register" method="post" action="ControllerVincentTestBD.php">
                <label>SUPPRIMER UNE DISCUSSION</label><br/>
                        
                <label name="DisASuppr">Id de la discussion a fermer</label>
                <input name="DisASuppr" type="text" required><br/>
                
                <button  name="SupprDis" type="submit" value="Envoyer">Supprimer Discussion</button><br/>
            </form>
      </div>';





echo '<form id="UserBD" method="post" action="ControllerVincentTestBD.php">
            <label name="idUser">Id User</label>
            <input name="idUser" type="text" required><br/>
            <button name="TestUserBD" type="submit" value="ResultatUserBD">TestUserBD</button><br/>
      </form>';

echo '<div class="container black">
            <form id="register" method="post" action="ControllerVincentTestBD.php">
                <label>REGISTER</label><br/>
                            
                <label name="Nom">Nom User</label>
                <input name="Nom" type="text" required><br/>
                
                <label name="Mail">Mail</label>
                <input name="Mail" type="text" required><br/>
                
                <label name="Mdp">Mot de passe</label>
                <input name="Mdp" type="text"><br/>
                
                <button name="UserAdd" type="submit" value="Envoyer">Creer</button><br/>
            </form>
     
            <form id="register" method="post" action="ControllerVincentTestBD.php">
                <label>LOGIN</label><br/>
            
                
                <label name="Identifiant">Login </label>
                <input name="Identifiant" type="text" required><br/>
                
                <label name="Pwd">Mot de Passe</label>
                <input name="Pwd" type="password" required><br/>
                
                <button name="Connexion" type="submit" value="Envoyer">Connexion</button><br/>
            </form>
            
            
            <form id="register" method="post" action="ControllerVincentTestBD.php">
                <label>MOT DE PASSE OUBLIE</label><br/>
            
                
                <label name="Mail">Mail </label>
                <input name="Mail" type="text" required><br/>
                
                <button name="ForgetMDP" type="submit" value="Envoyer">Connexion</button><br/>
            </form>
            
            <form id="register" method="post" action="ControllerVincentTestBD.php">
                <label>SUPPRIMER USER</label><br/>
            
                
                <label name="LogS">Login </label>
                <input name="LogS" type="text" required><br/>
                
                <button name="SupprUser" type="submit" value="Envoyer">Supprimer</button><br/>
            </form>
            
      </div>';






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
            
            
            <form id="register" method="post" action="ControllerVincentTestBD.php">
                <label>CLORE UN MESSAGE</label><br/>
            
                
                <label name="idMsgC">Id Msg </label>
                <input name="idMsgC" type="text" required><br/>
                <button type="submit" value="Envoyer">Clore</button><br/>
            </form>
            
            
            
            
            <form id="register" method="post" action="ControllerVincentTestBD.php">
                <label>SUPPRIMER UN MESSAGE</label><br/>
            
                
                <label name="idMsgS">Id Msg </label>
                <input name="idMsgS" type="text" required><br/>
                <button type="submit" value="Envoyer">Supprimer</button><br/><br/><br/><br/>
            </form>
            
        </div>';
