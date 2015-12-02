<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/officiallogoblack.png">

    <title>Dormitories.sg</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">
    <link href="ADSConsumer.css" rel="stylesheet">

    <!-- jQuery and Bootstrap Javascript -->
    <script type="text/javascript" src="datatables/media/js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body role="document">
    <script type="text/javascript">
        $(function(){
            $("#header").load("header.php");
        });
    </script>

    <div id="header">
    </div>

    <!--- Background Image Area ---->
    <div class="jumbotron" id="background-area">
        <div class="container theme-showcase" id="background-area-subcontainer" role="main">
            <h4>Test</h4>

            <!---- Search Area --->
            <form class="form-horizontal" role="form" action="searchResults.php" method="post">
                <div class="form-group" id="search-area">
                    <div class="col-sm-3 col-md-4">
                        <input type="text" class="form-control" name="searchField" id="searchField" placeholder="Search...">
                    </div>

                    <div class="col-sm-3 col-md-2">
                        <input type="text" class="form-control" name="searchStartDate" id="searchStartDate" placeholder="Start Date" onmouseover="this.type = 'date'" onmouseout="this.type = 'text'">
                    </div>

                    <div class="col-sm-3 col-md-2">
                        <input type="text" class="form-control" name="searchEndDate" id="searchEndDate" placeholder="End Date" onmouseover="this.type = 'date'" onmouseout="this.type = 'text'">
                    </div>

                    <div class="col-sm-3 col-md-2">
                        <select class="form-control" name="locDropDown" id="locDropDown">
                            <option value=""> Select an option...</option>
                            <option> North</option>
                            <option> South</option>
                            <option> East</option>
                            <option> West</option>
                            <option> Central</option>
                        </select>
                    </div>
                    <div class="col-sm-3 col-md-2">
                        <button type="submit" class="btn btn-success" id="search-button" name="submit">Search</button>
                    </div>
                </div>
            </form>
            <!---- End Search Area --->
        </div>
    </div>
    <!--- End Background Image Area ---->
</body>
</html>
