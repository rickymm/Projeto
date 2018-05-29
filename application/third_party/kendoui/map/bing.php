<?php
require_once '../lib/Kendo/Autoload.php';

require_once '../include/header.php';

$layer = new \Kendo\Dataviz\UI\MapLayer();
$layer->type("bing")
      ->imagerySet("aerialWithLabels")

      // IMPORTANT: This key is locked to demos.telerik.com/kendo-ui
      // Please replace with your own Bing Key
      ->key("AqaPuZWytKRUA8Nm5nqvXHWGL8BDCXvK8onCl2PkC581Zp3T_fYAQBiwIphJbRAK");

$map = new \Kendo\Dataviz\UI\Map('map');
$map->center(array(51.505, -0.09))
    ->zoom(3)
    ->addLayer($layer);

echo $map->render();
?>
<?php require_once '../include/footer.php'; ?>
