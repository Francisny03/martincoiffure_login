<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('tronquerTexte')) {
    function tronquerTexte($texte, $limite, $fin = '...') {
        if (strlen($texte) > $limite) {
            $texte = substr($texte, 0, $limite) . $fin;
        }
        return $texte;
    }
}

if (!function_exists('deconnexionSession')) {
    function deconnexionSession() {
        $inactivityLimit = 600; // Limite d'inactivité (10 minutes)

        if (isset($_SESSION['id_admin'])) {
            if (isset($_SESSION['last_activity'])) {
                $timeSinceLastActivity = time() - $_SESSION['last_activity'];
                if ($timeSinceLastActivity > $inactivityLimit) {
                    session_unset(); // Nettoyer la session
                    session_destroy(); // Détruire la session
                }
            }
            $_SESSION['last_activity'] = time(); // Mise à jour de l'activité
        }
    }
}
?>