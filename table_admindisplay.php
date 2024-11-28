<?php
include('include/db.php');
$req_admin = "SELECT * FROM admin";

$stmt_admin = $conn->prepare($req_admin);
$stmt_admin->execute();
$result_admin = $stmt_admin->fetchAll();
?>

<?php
            foreach($result_admin as $results){
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
    <td><button class="button btns modifier_admin"
            data-id_admin="<?php echo htmlspecialchars($results["id_admin"]); ?>">Modifier</button>
    </td>

</tr>
<?php
            }
?>