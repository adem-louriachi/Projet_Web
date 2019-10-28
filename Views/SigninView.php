<?php
$style = 'Views/HomeView.css';
ob_start(); 
?>
    <div class="container black">
        <form id="signin" method="post" action="/?ctrl=User&action=register">
            <label name="nick">Pseudo</label>
                <input name="nick" type="text" placeholder="FrenchCookie">
        </form>
    </div>
<?php
$content = ob_get_clean();
require 'Views/TemplateView.php';
?>
