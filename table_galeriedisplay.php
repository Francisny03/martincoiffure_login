<?php
$PDO = getConn();
$req = "SELECT * FROM galeries";

$stmt = $PDO->prepare($req);
$stmt->execute();
$result = $stmt->fetchAll();
?>


<?php
foreach($result as $results) {
    ?>
<tr>
    <td><?php echo $results["id_galerie"] ?></td>
    <td><?php echo $results["titre"] ?></td>
    <td><img src="<?php echo $results["image"] ?>" alt="Image principale"></td>
    <td>
        <?php
        $additionalImages = json_decode($results["images"]);
        if (is_array($additionalImages)) {  // Check if decoding was successful
            foreach ($additionalImages as $img) {
                echo '<img src="' . $img . '" alt="Image supplémentaire" style="width:50px; height:50px;"> ';
            }
        } else {
            echo "No additional images available";
        }
        ?>
    </td>
    <td><?php echo $results["position"] ?></td>
    <td><button class="button btns modifier_galerie" data-id_galerie="<?php echo htmlspecialchars($results["id_galerie"]); ?>">Modifier</button></td>

</tr>
<?php
}
?>