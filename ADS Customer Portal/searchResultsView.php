<?php
//include('login.php'); // Includes Login Script
//
//if(!isset($_SESSION['loginID'])){
//    header("location: index.php");
//}

include('searchResults.php');
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

//        if(parent.document.URL.indexOf('?') > -1){
//            var qs = parent.document.URL.split("?");
//            qs = qs[1].split("&");
//            var dormID = qs[0].split("=");
//            dormID = dormID[1];
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
//        }
//
//        var ownerID = <?php //echo json_encode($_SESSION['loginID']); ?>//;
//        var adminID = <?php //echo json_encode($_SESSION['adminID']); ?>//;
//        var permissions = <?php //echo json_encode($_SESSION['permissions']); ?>//;

//        if (window.XMLHttpRequest) {
//            // code for IE7+, Firefox, Chrome, Opera, Safari
//            xmlhttp = new XMLHttpRequest();
//        } else {
//            // code for IE6, IE5
//            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//        }
//        xmlhttp.onreadystatechange = function() {
//            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//                var result = $.parseJSON(xmlhttp.responseText);
//
//                document.getElementById("dormName").innerHTML = result[0];
//
//                for(var j = 0; j < result[1].length; j++){
//                    $("#busDropdown").append("<option value="+ result[2][j] + ">" + result[1][j] + "</option>");
//                }
//
//                roomUnitNo = result[3];
//                roomCurCapacity = result[4];
//                roomMaxCapacity = result[5];
//
//                for(j = 0; j < roomUnitNo.length; j++){
//                    $("#roomDropdown").append("<option>" + roomUnitNo[j] + "</option>");
//                }
//            }
//        };
//        xmlhttp.open("GET","queryDormDetailedView.php?ownerID="+ownerID+"&dormID="+dormID,true);
//        xmlhttp.send();
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
//            if(permissions == "all" || permissions == "owner"){
//                buttons.splice(4,0,{
//                    "sExtends":    "viewBarcode",
//                    "sButtonText": "View Barcode"
//                });
//            }

            adjustWidth();
            updateSearchResult();

            function adjustWidth(){
                if(screen.width < 1200){
                    document.getElementById("searchResultsMediaDiv").className = "media-list col-sm-10 col-md-9";
                    document.getElementById("filterDiv").className = "col-sm-12 col-md-12 main"
                }
            }

            function updateSearchResult(){
                var dormOwnerID = <?php echo json_encode($_SESSION['dormOwnerID']); ?>;
                var dormID = <?php echo json_encode($_SESSION['dormID']); ?>;
                var dormName = <?php echo json_encode($_SESSION['dormName']); ?>;
                var dormAddress = <?php echo json_encode($_SESSION['dormAdd']); ?>;
                var dormPricing = <?php echo json_encode($_SESSION['dormPricing']); ?>;
                var dormCap = <?php echo json_encode($_SESSION['dormCap']); ?>;
                var dormRating = <?php echo json_encode($_SESSION['dormRating']); ?>;
                var dormFacilities = <?php echo json_encode($_SESSION['dormFacilities']); ?>;

                var ul = document.getElementById("searchResultsMedia");

                for(var i = 0; i < dormName.length; i++){
                    var li = document.createElement("li");
                    li.setAttribute("class", "list-group-item");

                    var divLeft = document.createElement("div");
                    divLeft.setAttribute("class", "media-left");

                    var img = document.createElement("img");
                    img.setAttribute("class", "media-object");
                    img.setAttribute("src", "data/"+ dormID[i] +"/ss1.png");

                    if(screen.width < 1200)
                        img.setAttribute("width", "200px");
                    divLeft.appendChild(img);

                    var divBody = document.createElement("div");
                    divBody.setAttribute("class", "media-body");

                    var h4 = document.createElement("h4");
                    h4.setAttribute("class", "media-heading");
                    h4.innerHTML = '<strong><a href="dormProfileView.php?dormID='+dormID[i]+'">'+dormName[i]+'</a></strong>';

                    var span = document.createElement("span");
                    span.innerHTML = '<br>Address: ' + String(dormAddress[i]).replace(/~/g, " ") + '<br>' +
                    'Availability: ' + dormCap[i] + ' beds <br>';

                    var ratingDiv = document.createElement("div");
                    ratingDiv.setAttribute("style", "position:absolute; top: 50px; right: 20px");

                    var ratingSpan = document.createElement("span");
                    ratingSpan.appendChild(document.createTextNode("Rating: "));

                    var starRatingSpan = document.createElement("span");
                    starRatingSpan.setAttribute("class", "starRating");

                    for(var j = 5; j >= 1; j--){
                        var input = document.createElement("input");
                        input.setAttribute("id", "rating-"+dormID[i]+"-"+j);
                        input.setAttribute("type", "radio");
                        input.setAttribute("value", ""+j);
                        input.setAttribute("name", "rating-"+dormID[i]);
                        input.setAttribute("disabled", "true");

                        var label = document.createElement("label");
                        label.setAttribute("for", "rating-"+dormID[i]+"-"+j);
                        label.appendChild(document.createTextNode(""+j));

                        if(dormRating[i] == j)
                            input.setAttribute("checked", "true");

                        starRatingSpan.appendChild(input);
                        starRatingSpan.appendChild(label);
                    }

                    var ratingText = document.createElement("h4");
                    ratingText.setAttribute("class", "greenHighlight");
                    ratingText.setAttribute("style", "position:relative;left: 30px");

                    if(dormRating[i] == "1"){
                        ratingText.appendChild(document.createTextNode("Cheap!"));
                    }
                    else if(dormRating[i] == "2"){
                        ratingText.appendChild(document.createTextNode("Okay!"));
                    }
                    else if(dormRating[i] == "3"){
                        ratingText.appendChild(document.createTextNode("Good!"));
                    }
                    else if(dormRating[i] == "4"){
                        ratingText.appendChild(document.createTextNode("Very Good!"));
                    }
                    else if(dormRating[i] == "5"){
                        ratingText.appendChild(document.createTextNode("Excellent!"));
                    }

                    ratingDiv.appendChild(ratingSpan);
                    ratingDiv.appendChild(starRatingSpan);
                    ratingDiv.appendChild(ratingText);

                    var facilitiesDiv = document.createElement("div");
                    facilitiesDiv.setAttribute("style", "position:absolute; bottom: 80px");

                    var facilitiesText = document.createElement("h4");

                    for(j = 0; j < dormFacilities[i].length; j++){
                        img = document.createElement("img");
                        img.setAttribute("src", "images/tickgreen.png");
                        facilitiesText.appendChild(img);
                        facilitiesText.appendChild(document.createTextNode(dormFacilities[i][j] + " "));
                    }

                    facilitiesDiv.appendChild(facilitiesText);

                    var bodyBottomDiv = document.createElement("div");
                    bodyBottomDiv.setAttribute("style", "width: 65%;border-top: 1px solid #596360;position: absolute; bottom: 50px");

                    var price = document.createElement("h4");
                    price.setAttribute("style", "position: absolute; top: 5px; right: 130px");
                    price.innerHTML = '<strong>Per Month: $' + dormPricing[i] + '</strong>';

                    var button = document.createElement("button");
                    button.setAttribute("type", "button");
                    button.setAttribute("class", "btn btn-success");
                    button.setAttribute("style", "position: absolute; top: 5px; right: 10px");
                    button.setAttribute("onclick", "dormProfileViewPage(\"" + dormOwnerID[i] + "\",\"" + dormID[i] +"\");");
                    button.appendChild(document.createTextNode("View Details"));

                    bodyBottomDiv.appendChild(price);
                    bodyBottomDiv.appendChild(button);

                    divBody.appendChild(h4);
                    divBody.appendChild(span);
                    divBody.appendChild(ratingDiv);
                    divBody.appendChild(facilitiesDiv);
                    divBody.appendChild(bodyBottomDiv);

                    li.appendChild(divLeft);
                    li.appendChild(divBody);

                    ul.appendChild(li);
                }
            }
        } );

        function dormProfileViewPage( ownerID, dormID ){
            window.open("dormProfileView.php?ownerID=" + ownerID + "&dormID=" + dormID, "_blank");
        }
    </script>
</head>

<body>
<div id="header"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <form class="form-horizontal" role="form" action="searchResults.php" method="post">
                <h4 style="padding-left: 20px;padding-top: 20px"> Search: </h4>
                <div class="form-group" style="padding-left: 20px">
                    <!--                    <label class="control-label col-sm-3 col-md-2" for="tenName1">Dormitories Search: </label>-->
                    <div class="col-sm-3 col-md-2">
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
                        <button type="submit" class="btn btn-success" name="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div id="filterDiv" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">
                <span> Search Results</span>
            </h1>
            <div class="col-sm-4 col-md-3" style="display: inline-block">
                <h2 class="sub-header">
                    <span> Narrow your results: </span>
                </h2>

                <form class="form-horizontal" role="form" action="searchResults.php" method="post">
                    <h4 style="padding-left: 20px;padding-top: 20px"> Dormitory Name: </h4>
                    <div class="form-group filterSearch" style="padding-left: 20px">
                        <div class="col-sm-12 col-md-12">
                            <input type="text" class="form-control" name="filterDormName" id="filterDormName" placeholder="Enter dormitory name...">
                        </div>
                    </div>

                    <h4 style="padding-left: 20px;padding-top: 20px"> Price Range: </h4>
                    <div class="form-group filterSearch" style="padding-left: 20px">
                        <div class="col-sm-12 col-md-12">
                            <input type="text" class="form-control" name="filterPrice" id="filterPrice" placeholder="Enter price...">
                        </div>
                    </div>
                </form>
            </div>
            <div id="searchResultsMediaDiv" class="media-list col-sm-8 col-md-7">
                <ul id="searchResultsMedia"></ul>
            </div>
        </div>
    </div>
</div>

<div class="container marketing">
    <div id="footer"></div>
</div>

</body>
</html>
