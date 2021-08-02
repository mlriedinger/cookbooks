<?php 

$title = "Accueil";
?>

<?php ob_start(); ?>

    <h2>Bienvenue!</h2>

    <div class="row mt-5">
        <form action="index.php?action=export" method="POST">
            <div class="col">
                <input type="submit" value="Exporter" class="btn btn-dark"/>
            </div>
        </form>
    </div>
    

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
    <script>
    </script>

<?php $script = ob_get_clean(); ?>

<?php require 'template.php'; ?>