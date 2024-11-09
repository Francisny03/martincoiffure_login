<?php
function tronquerTexte($texte, $limite, $fin = '...') {
    if (strlen($texte) > $limite) {
        $texte = substr($texte, 0, $limite) . $fin;
    }
    return $texte;
}

?>