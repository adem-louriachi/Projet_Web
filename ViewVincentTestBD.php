<?php

require 'Models/MessagesMod.php';

echo '<div class="container black">
        <form id="register" method="post" action="ControllerVincentTestBD.php">
            <label name="Message">Message</label>
            <input name="Message" type="text" required>
            <button type="submit" value="Envoyer">Envoyer</button>
        </form>
    </div>';
