<?php
// Ejecutamos la lógica de arranque de la app, o lógica de bootstrap
include_once('autoloader.php');
use \Javiers\Agenda\csvmanager;
// If we recieve post action = edited we are updating member.
if($_POST['action']!="edit")
{
    
    // UPDATE data
    csvmanager::getInstance(__DIR__ .  "/../address/example.csv")
    ->update($_POST)
    ->write();
    // Redirect back to home
    header('Location: /csvmanager/list.php');
    exit;
}
// Not POST lets crUd.
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../views/head.php'; ?>
<body>
    <div class="container-narrow">
        <div class="masthead">
            <h3 class="muted">CSV Manager</h3>
        </div>
        <div class="jumbotron">
            <a class="btn btn-large btn-success" href="list.php">&lt;&lt; Back</a>
        </div>
        <hr />
        <h3>Update Contact</h3>
        <form role="form" method="post" enctype='application/json' accept-charset="UTF-8">
            <div class="form-group">
                <label for="name">Name:</label> <input type="text" class="form-control" id="name" name="name"
                    value="<?php echo $_POST['name']; ?>" placeholder="Write your name..." required>
            </div>
            <div class="form-group">
                <label for="telephone">Telephone:</label> <input type="tel" – telephone-number-input field
                    pattern="[5-9][0-9]{8}" class="form-control" id="telephone" name="telephone"
                    value="<?php echo $_POST['telephone']; ?>" placeholder="Write your telephone..." required>
                <h6>valid telephone number begins with #5-9 and has 9digits</h6>
            </div>
            <div class="form-group">
                <label for="address">Address:</label> <input type="address" class="form-control" id="address"
                    name="address" value="<?php echo $_POST['address'];?>" placeholder="Write your address..." required>
                    <input type="hidden" name="id" id="id" value="<?php echo $_POST['id']; ?>" />
            </div>
            <button type="submit" class="btn btn-default">Save Changes</button>
        </form>
        <hr />
        <?php include '../views/footer.php'; ?>
    </div>
</body>
</html>