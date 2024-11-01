<?php
function getConn() {
    return new PDO("mysql:host=localhost;dbname=martin_coiffure;charset=utf8", "root", "");
}
?>


<?php
function tronquerTexte($texte, $limite, $fin = '...') {
    if (strlen($texte) > $limite) {
        $texte = substr($texte, 0, $limite) . $fin;
    }
    return $texte;
}

?>