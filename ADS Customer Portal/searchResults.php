<?php
session_start(); // Starting Session

if (isset($_POST['submit'])) {
//
// Configuration
//   Load the database connection configuration options
//
    if (!isset($sql_details)) {
        include("php/config.php");
    }

    $con = mysqli_connect($sql_details["host"], $sql_details["user"], $sql_details["pass"], $sql_details["db"]);
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }

    $ownerID = array();

    $sql = "SELECT * FROM OwnerTable";
    $result = mysqli_query($con, $sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            array_push($ownerID, $row['chimericID']);
        }
    }

    $dormID = array();
    $dormName = array();
    $dormAdd = array();
    $dormCap = array();
    $dormPricing = array();
    $dormRating = array();

    for ($i = 0; $i < count($ownerID); $i++) {
        $ownerDIID = "DI_" . $ownerID[$i];

        $sql = "SELECT * FROM $ownerDIID";
        $result = mysqli_query($con, $sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                array_push($dormID, $row['dormID']);
                array_push($dormName, $row['dormName']);
                array_push($dormAdd, $row['dormAddress']);
                array_push($dormCap, $row['maxCapacity'] - $row['currentCapacity']);
                array_push($dormPricing, $row['pricingPerMonth']);
                array_push($dormRating, $row['rating']);
            }
        }
    }

    // Initializing Session
    $_SESSION['dormID'] = $dormID;
    $_SESSION['dormName'] = $dormName;
    $_SESSION['dormAdd'] = $dormAdd;
    $_SESSION['dormPricing'] = $dormPricing;
    $_SESSION['dormCap'] = $dormCap;
    $_SESSION['dormRating'] = $dormRating;

    header("Location: searchResultsView.php");

    mysqli_close($con);
}
?>