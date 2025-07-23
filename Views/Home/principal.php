<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/ProyectoG8/Views/layoutInterno.php';
?>

<!DOCTYPE html>
<html>
<?php
AddCss();
?>

<body>

    <div id="main-wrapper">

        <?php
        ShowHeader();
        ShowMenu();
        ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Bienvenidos </h4>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <b class="logo-icon">
                            <img src="../Imagenes/fondo.jpg" alt="homepage" class="dark-logo" width="100%"
                                height="100%" />
                        </b>

                    </div>
                </div>
            </div>

            <?php
            ShowFooter();
            ?>

        </div>

    </div>

    <?php
    AddJs();
    ?>

</body>

</html>