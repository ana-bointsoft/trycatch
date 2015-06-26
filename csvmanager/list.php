<?php
// lets list

include_once('autoloader.php');
use \Javiers\Agenda\csvmanager;
// Gather contact's data from CSV
$contacts = csvmanager::getInstance(__DIR__ .  "/../address/example.csv")
->getCsv()
->contact; // gather the obtained  data into this array
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
            <a class="btn btn-large btn-success" href="add.php">Add Contact</a>
            <?php
            // no data message
            if(empty($contacts))
{ ?>
            <h4>No data avalaible</h4>
            <?php
}
else
{ 
     include '../views/list.php'; 
} ?>
       
        </div>
        <hr>
        <?php include '../views/footer.php'; ?>
    </div>
</body>
</html>
