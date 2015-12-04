<?php
include('ADSGlobals.php');
$ownerID = $_POST['ownerID'];
$ownerDIID = "DI_".$ownerID;
$dormID = $_POST['dormID'];

//
// Configuration
//   Load the database connection configuration options
//
if ( ! isset( $sql_details ) ) {
    include( "php/config.php" );
}

$con = mysqli_connect($sql_details["host"],$sql_details["user"],$sql_details["pass"],$sql_details["db"]);
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM $ownerDIID WHERE dormID = '$dormID'";
$result = mysqli_query($con,$sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $dormName = $row['dormName'];
        $dormAdd = $row['dormAddress'];
        $dormCap = $row['maxCapacity'] - $row['currentCapacity'];
        $dormPricing = $row['pricingPerMonth'];
        $dormRating = $row['rating'];
        $dormFacilities = array();

        $tempFac = str_split($row['facilities']);

        for($j = 0; $j < count($tempFac); $j++){
            if($tempFac[$j] == '1'){
                array_push($dormFacilities, $dormFacText[$j]);
            }
        }
    }
}

echo json_encode(array($dormName, $dormAdd, $dormCap, $dormPricing, $dormRating, $dormFacilities));

mysqli_close($con);
?>