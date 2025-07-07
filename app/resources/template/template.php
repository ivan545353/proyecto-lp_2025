<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        require_once APP_DIR_TEMPLATE . 'includes/head.php';

        foreach($this->scripts as $script){
            echo '<script defer type="module" src="' . $script . '"></script>';
        }

        foreach($this->styles as $style){
            echo '<link rel="stylesheet" href="' . $style . '">';
        }
    ?>
</head>
<body class="body d-flex flex-column justify-content-between">
    <?php
        require_once APP_DIR_TEMPLATE . 'includes/menu.php';
    ?>

    <main class="container my-5">
        <?php
            require_once APP_DIR_VIEWS . $this->view;
        ?>
    </main>

    <footer class="bg-light text-dark border-top mt-5 py-4">
        <?php
            require_once APP_DIR_TEMPLATE . "includes/footer.php";
        ?>
    </footer>
</body>
</html>