<?php
//include('login.php'); // Includes Login Script
//
//if(!isset($_SESSION['loginID'])){
//    header("location: index.php");
//}
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
    <!--<meta http-equiv="refresh" content="15">-->
    <link rel="icon" href="images/officiallogoblack.png">

    <title>Dormitories.sg</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="view.css" rel="stylesheet">

    <!-- Integration CSS (provides all the styles required by DataTables and TableTools -->
    <link rel="stylesheet" type="text/css" href="datatables/media/css/dataTables.bootstrap.css">

    <!-- jQuery and Bootstrap Javascript -->
    <script type="text/javascript" src="datatables/media/js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- DataTables, TableTools and ColVis Javascript -->
    <script type="text/javascript" src="datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>
    <script type="text/javascript" src="datatables/media/js/moment.min.js"></script>
    <script type="text/javascript" src="datatables/media/js/datetime-moment.js"></script>

    <!-- Integration Javascript -->
    <script type="text/javascript" src="datatables/media/js/dataTables.bootstrap.js"></script>

    <!--Custom Javascripts-->
    <script type="text/javascript" src="ADSUtilities.js"></script>

    <script type="text/javascript">
        $(function(){
            $("#header").load("header.php");
            $("#footer").load("footer.php");
        });

        if(parent.document.URL.indexOf('?') > -1){
            var qs = parent.document.URL.split("?");
            qs = qs[1].split("&");
            var ownerID = qs[0].split("=");
            ownerID = ownerID[1];

            var dormID = qs[1].split("=");
            dormID = dormID[1];
//            var searchText = qs[2].split("=");
//            searchText = searchText[1];
//
//            if(searchText != ""){
//                if(searchText.indexOf('%') > -1)
//                {
//                    searchText = searchText.replace(/%20/g, " ");
//                }
//
//                searchText = '"' + searchText + '"';
//            }
        }
//
//        var ownerID = <?php //echo json_encode($_SESSION['loginID']); ?>//;
//        var adminID = <?php //echo json_encode($_SESSION['adminID']); ?>//;
//        var permissions = <?php //echo json_encode($_SESSION['permissions']); ?>//;
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
//            if(permissions == "all" || permissions == "owner"){
//                buttons.splice(4,0,{
//                    "sExtends":    "viewBarcode",
//                    "sButtonText": "View Barcode"
//                });
//            }

//            adjustWidth();
            getDormDetails( ownerID, dormID );

//            function adjustWidth(){
//                if(screen.width < 1200){
//                    document.getElementById("searchResultsMediaDiv").className = "media-list col-sm-10 col-md-9";
//                    document.getElementById("filterDiv").className = "col-sm-12 col-md-12 main"
//                }
//            }

            function getDormDetails( ownerID, dormID ){
                $.post("queryDormProfileView.php", {
                    ownerID: ownerID,
                    dormID: dormID
                }, function(data){
                    var result = $.parseJSON(data);

                    document.getElementById("dormName").innerHTML = result[0];

                    var dormAdd = result[1].split("~");
                    result[1] = String(result[1]).replace(/~/g, ' ');
                    document.getElementById("dormAdd").innerHTML = result[1];

                    var mapFrame = document.getElementById("dormMap");
                    mapFrame.setAttribute("style", "position:relative; left: 50px");
                    mapFrame.setAttribute("frameborder", "0");
                    mapFrame.setAttribute("scrolling", "no");
                    mapFrame.setAttribute("marginheight", "0");
                    mapFrame.setAttribute("marginwidth", "0");
                    mapFrame.setAttribute("width", "500");
                    mapFrame.setAttribute("height", "380");
                    mapFrame.setAttribute("src", "https://maps.google.com/maps?hl=en&q="+ dormAdd[2] +"&ie=UTF8&t=roadmap&z=16&iwloc=B&output=embed");

                    document.getElementById("dormCap").innerHTML = "Only " + result[2] + " beds left";

                    document.getElementById("bookBtn").innerHTML = "Book now from $" + result[3] + " /month";

                    if(result[4] == "1"){
                        document.getElementById("ratingText").innerHTML = "Cheap!";
                    }
                    else if(result[4] == "2"){
                        document.getElementById("ratingText").innerHTML = "Okay!";
                    }
                    else if(result[4] == "3"){
                        document.getElementById("ratingText").innerHTML = "Good!";
                    }
                    else if(result[4] == "4"){
                        document.getElementById("ratingText").innerHTML = "Very Good!";
                    }
                    else if(result[4] == "5"){
                        document.getElementById("ratingText").innerHTML = "Excellent!";
                    }
                    document.getElementById("rating"+result[4]).checked = true;

                    var div = document.getElementById("dormDescDiv");

                    for(var i = 0; i < result[5].length%3+1; i++){
                        var rowFacDiv = document.createElement("div");
                        rowFacDiv.setAttribute("class", "col-md-12 col-sm-12");

                        for(var j = 0; j < 3; j++){
                            var index = i*3+j;
                            if(result[5][index] != null){
                                var facDiv = document.createElement("div");
                                facDiv.setAttribute("class", "col-sm-3 col-md-4");
                                var facilitiesText = document.createElement("h4");
                                var img = document.createElement("img");
                                img.setAttribute("src", "images/tickgreen.png");
                                facilitiesText.appendChild(img);
                                facilitiesText.appendChild(document.createTextNode(result[5][index] + " "));

                                facDiv.appendChild(facilitiesText);
                                rowFacDiv.appendChild(facDiv);
                            }
                            else
                                break;
                        }

                        div.appendChild(rowFacDiv);
                    }

                    var descDiv = document.createElement("div");
                    descDiv.setAttribute("class", "col-sm-12 col-md-12");
                    descDiv.setAttribute("style", "border-top: 1px solid #596360");
                    var h4 = document.createElement("h4");
                    h4.appendChild(document.createTextNode("Sample Description"));
                    descDiv.appendChild(h4);
                    div.appendChild(descDiv);
                });
            }
        } );

        function searchResultViewPage(){
            location.href = "searchResultsView.php";
        }

        function bookDormitoryPage(){
            location.href = "bookDormitoryView.php";
        }
    </script>
</head>

<body>
<div id="header"></div>

<div class="container theme-showcase" role="main">
    <div class="row">
        <div style="padding-top: 20px;padding-bottom: 20px">
            <strong><a href="javascript:searchResultViewPage()" style="padding-bottom: 20px">Search results</a></strong>
        </div>

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <h2 id="dormName"></h2>
            <h4 id="dormAdd"></h4>
            <h4><label class="label label-warning" id="dormCap"></label></h4>
            <div>
                <button type="button" id="bookBtn" class="btn btn-success" onclick="bookDormitoryPage()"> Book Now </button>
            </div>
            <span class="starRating" style="position:relative;top: 10px">
              <input id="rating5" type="radio" name="rating" value="5">
              <label for="rating5">5</label>
              <input id="rating4" type="radio" name="rating" value="4">
              <label for="rating4">4</label>
              <input id="rating3" type="radio" name="rating" value="3">
              <label for="rating3">3</label>
              <input id="rating2" type="radio" name="rating" value="2">
              <label for="rating2">2</label>
              <input id="rating1" type="radio" name="rating" value="1">
              <label for="rating1">1</label>
            </span>
            <h4 id="ratingText" class="greenHighlight" style="position:relative;left: 5px;top: 10px"></h4>
        </div>
    </div>

    <div class="row">
        <h1 class="page-header">Dormitory Facilities</h1>

        <div id="dormDescDiv" class="col-sm-7 col-md-6"></div>

        <iframe id="dormMap"></iframe>
    </div>

    <div id="footer"></div>
</div>

</body>
</html>
