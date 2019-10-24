<?php



spl_autoload_register(function ($class) {
        require 'Controllers/' . $class . '.php';
        require 'Models/' . $class . '.php';
});

