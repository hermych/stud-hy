    </div>
    <!-- ########### LINKS DE JQUERY ###########  -->
    <script src="../assets/js/librerias/jquery-3.6.0.min.js"></script>
    <!-- ########### LINK DE DATATABLES ############## -->
    <script src="../assets/js/librerias/datatables.min.js"></script>
    <!-- ########### LINKS PROPIOS ############ -->
    <?php
    $porciones = explode("?", $_SERVER["REQUEST_URI"]);
    if (count($porciones) > 1) {
        $porciones2 = explode("=", $porciones[1]);
        if ($porciones2[1] == 'loginView') {
            $script = '<script src="../assets/js/login/login.js"></script>';
            echo $script;
        } elseif ($porciones2[1] == 'registroView') {
            $script = '<script src="../assets/js/login/registro.js"></script>';
            echo $script;
        } elseif ($porciones2[1] == 'facultadGView') {
            $script = '<script src="../assets/js/universidad/index.js"></script>';
            echo $script;
        } elseif ($porciones2[1] == 'universidadGView') {
            $script = '<script src="../assets/js/facultad/index.js"></script>';
            echo $script;
        }
    }
    ?>
    </body>

    </html>