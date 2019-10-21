<?php
ob_start();
$style = 'HomeView.css';
?>

<?php
$content = ob_get_clean();
require '../Views/TemplateView.php';
?>