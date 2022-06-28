    </div> <!--  3 -->
    </div> <!--  1 -->
    </div> <!--  1 -->
    <!-- ########### probando ###########  -->
    <script src="../assets/js/librerias/sidebar.js"></script>
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
            $script = '<script src="../assets/js/facultad/indexG.js"></script>';
            echo $script;
        } elseif ($porciones2[1] == 'universidadView') {
            $script = '<script src="../assets/js/universidad/universidad.js"></script>';
            echo $script;
        } elseif ($porciones2[1] == 'universidadGView') {
            $script = '<script src="../assets/js/universidad/indexG.js"></script>';
            echo $script;
        } elseif ($porciones2[1] == 'carreraGView') {
            $script = '<script src="../assets/js/carrera/index.js"></script>';
            echo $script;
        } elseif ($porciones2[1] == 'plan_estudioView') {
            $script = '<script src="../assets/js/plan_estudio/plan_estudio.js"></script>';
            echo $script;
        }
    }
    ?>
    </body>

    </html>