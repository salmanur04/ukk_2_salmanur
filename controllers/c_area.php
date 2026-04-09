 <?php
include_once __DIR__ . '/../models/area.php';

$area = new area();

/* ===============================
   TAMPIL DATA AREA
   =============================== */
$data_area = $area->tampil_data_area();
?>