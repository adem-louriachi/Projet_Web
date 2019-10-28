<?php
ob_start();
$style = 'MessageView.css';
?>

<title>
    Discussion test<!-- Titre de la discussion genérée par requête PHP -->
</title>
<div class="discussion container #44d9e6 row">
    <h1>
        <!-- Pareil que pour le title -->
    </h1>
    <!-- Requête PHP de récup de message -->

    <div class="message msg black grey-text z-depth-3">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan nisi quis rutrum feugiat. Phasellus pharetra sem eros, non congue lorem faucibus sit amet. Phasellus tincidunt lorem lorem, et dapibus augue imperdiet vitae. Curabitur facilisis dictum nisi non ornare. Maecenas interdum elit sit amet lorem gravida, quis sollicitudin elit euismod. Fusce vel sem et arcu viverra ornare.</p>
    </div>
    <div class="message msg black grey-text z-depth-3">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan nisi quis rutrum feugiat. Phasellus pharetra sem eros, non congue lorem faucibus sit amet. Phasellus tincidunt lorem lorem, et dapibus augue imperdiet vitae. Curabitur facilisis dictum nisi non ornare. Maecenas interdum elit sit amet lorem gravida, quis sollicitudin elit euismod. Fusce vel sem et arcu viverra ornare.</p>
    </div>
    <div class="message msg black grey-text z-depth-3">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent accumsan nisi quis rutrum feugiat. Phasellus pharetra sem eros, non congue lorem faucibus sit amet. Phasellus tincidunt lorem lorem, et dapibus augue imperdiet vitae. Curabitur facilisis dictum nisi non ornare. Maecenas interdum elit sit amet lorem gravida, quis sollicitudin elit euismod. Fusce vel sem et arcu viverra ornare.</p>
    </div>

</div>

<?php
$content = ob_get_clean();
require '../Views/TemplateView.php';
?>