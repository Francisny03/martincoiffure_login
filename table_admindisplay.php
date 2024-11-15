<?php
$req = "SELECT * FROM admin ";

$stmt = $conn->prepare($req);
$stmt->execute();
$result = $stmt->fetchAll();
?>

<?php
            foreach($result as $results){
?>
<tr>

    <td>
        <?php echo $results["id_admin"] ?>
    </td>
    <td>
        <?php echo $results["name"] ?>
    </td>
    <td>
        <?php echo $results["email"] ?>
    </td>
    <td>
        <?php echo $results["role"] ?>
    </td>
    <td>
        <?php echo $results["created_at"] ?>
    </td>
    <td>
        <?php echo $results["updated_at"] ?>
    </td>
    <td><button class="button btns voirPlusBtn"
            data-id="<?php echo htmlspecialchars($results["id_admin"]); ?>">Modifier</button>
    </td>

</tr>
<?php
            }
?>