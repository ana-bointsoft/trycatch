<?php
$path =!empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');

if ($path == '/address')
{
  $controller = new \Controller();
  $return = $controller->ex();
  echo $return;
}

class Controller
{
 public $addresses;

  function ex()
  {
    $this->rcd();
    $id = $_POST['id'];
    $address = $this->addresses[$id];
    return json_encode($address);
  }

  function rcd()
  {
    $file = fopen('example.csv', 'r');
    while (($line = fgetcsv($file)) !== FALSE) {
        $this->addresses[] = array (
            'name' =>$line[0],
            'phone' => $line[1],
            'street' =>$line[2]
                );
        
    }

    fclose($file);
  }
}
?>
