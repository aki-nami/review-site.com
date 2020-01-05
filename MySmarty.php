<?php
include('libs/Smarty.class.php');
class MySmarty {

    public static function getSmarty() {
        $smarty = new Smarty();
        $smarty->template_dir = 'templates/';
        $smarty->compile_dir = 'templates_c/';

        //other settings

        return $smarty;
    }
}
?>
