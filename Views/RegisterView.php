<?php
    session_start();
    ob_start();
    $style = 'HomeView.css';
?>
<div class="container black">
    <form id="register" method="post" action="/Controllers/Register.php">
        <label name="nick">Nom</label>
        <input name="nick" type="text" placeholder="Jean" value="<?php if (isset($_SESSION['nick'])) echo $_SESSION['nick']; ?>" required autofocus>
        <label name="email">Adresse e-mail</label>
        <input name="email" type="email" placeholder="jean@jean.fr" value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email']; ?>" required>
        <label name="pwd"><?php  if (isset($_SESSION['errors'])) echo "<p style=\"color:red;\">".$_SESSION['errors'][0]."</p>"; ?> Mot de passe</label>
        <input name="pwd" type="password" required>
        <label name="pwdconf">Confirmation du mot de passe</label>
        <input name="pwdconf" type="password" required>
        <input id="submit" type="submit" value="Inscription">
    </form>
</div>
<?php
    $content = ob_get_clean();
    require '/Views/TemplateView.php';
?>