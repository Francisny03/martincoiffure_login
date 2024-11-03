<?php
$PDO = getConn();
$req = "SELECT * FROM services";
$stmt = $PDO->prepare($req);
$stmt->execute();
$result = $stmt->fetchAll();

?>


<?php
            foreach($result as $results){
            ?>
<tr>

    <td>
        <?php echo $results["id"] ?>
    </td>
    <td>
        <?php echo $results["titre"] ?>
    </td>
    <td>
        <?php
echo $texte_tronque = tronquerTexte($results["description"], 70); // Limite à 55 caractères (jusqu'à "et tendances")
        ?>
    </td>
    <td><img src="<?php echo $results["image1"] ?>" alt=""></td>
    <td><img src="<?php echo $results["image2"] ?>" alt=""></td>
    <td><?php echo $results["position"] ?></td>
    <td><button class="button btns modifier_service" data-id="<?php echo htmlspecialchars($results["id"]); ?>">Modifier</button></td>

</tr>
<?php
            }
?>