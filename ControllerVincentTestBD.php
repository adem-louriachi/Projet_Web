<?php

    if (isset($_POST['Message'])) {
        $message = $_POST['Message'];
        echo $message;
    }
    else{
        echo 'erreur';
    }