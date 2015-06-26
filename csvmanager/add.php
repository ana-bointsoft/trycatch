<?php
// Starting the app
include_once('autoloader.php');
use \Javiers\Agenda\csvmanager;
// If we recieve post we are adding new member.
if($_POST)
{
    include_once('autoloader.php');
    // We add new contact 
    csvmanager::getInstance(__DIR__ . "/../address/example.csv")
    ->add($_POST)
    ->write();
    // Redirect back to home
    header('Location: /csvmanager/list.php');
    exit;
}
// Not POST lets Crud.
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../views/head.php'; ?>
<body>
    <div class="container-narrow">
        <div class="masthead">
            <h3 class="muted">Agenda</h3>
        </div>
        <div class="jumbotron">
            <a class="btn btn-large btn-success" href="list.php">&lt;&lt; Back</a>
        </div>
        <hr />
        <h3>Add Contact</h3>
        <form role="form" method="post">
            <div class="form-group">
                <label for="name">Name :</label> <input type="text" class="form-control" id="name" name="name"
                    placeholder="Write a name..." required
                >
            </div>
            <div class="form-group">
                <label for="surname">Telephone:</label> 
                <input  type="tel" – telephone-number-input field pattern="[5-9][0-9]{8}" class="form-control" id="telephone"
                    name="telephone" placeholder="Phone number...6123456789" required ><h6>valid telephone number begins with #5-9 and has 9digits</h6>
            </div>
            <div class="form-group">
                <label for="address">Adress:</label> <input type="address" class="form-control" id="address" name="address"
                    placeholder="Write an address..." required>
                    <input type="hidden" name="id" id="id" value="newid" />
            </div>
            <button type="submit" class="btn btn-default">Save</button>
        </form>
        <hr />
        <?php include '../views/footer.php'; ?>
    </div>
</body>
</html>