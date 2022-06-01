    </div>
    <?php
    $porciones = explode("?", $_SERVER["REQUEST_URI"]);
    if (count($porciones) > 1) {
        $porciones2 = explode("=", $porciones[1]);
        if ($porciones2[1] == 'login') {
            $script = '<script src="../assets/js/login/login.js"></script>';
            echo $script;
        }
    }
    ?>
    </body>

    </html>