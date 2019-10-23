<?php

require 'Models/Model.php';
require 'Models/MessagesMod.php';

echo '<div class="container black">
        <form id="register" method="post" action="../Controllers/Register.php">
            <label name="Message">Message</label>
            <input name="Message" type="text" required>
            <button type="submit" value="Envoyer">Envoyer<i>send</i></button>
        </form>
    </div>';
