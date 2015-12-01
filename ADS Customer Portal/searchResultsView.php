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

    <title>Search Results</title>

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
//            $.fn.dataTable.moment( "DD-MM-YYYY" );

//            if(permissions == "all" || permissions == "owner"){
//                buttons.splice(4,0,{
//                    "sExtends":    "viewBarcode",
//                    "sButtonText": "View Barcode"
//                });
//            }

            var dormName = <?php echo json_encode($_SESSION['dormName']); ?>;
            var dormAddress = <?php echo json_encode($_SESSION['dormAdd']); ?>;
            var dormPricing = <?php echo json_encode($_SESSION['dormPricing']); ?>;
            var dormCap = <?php echo json_encode($_SESSION['dormCap']); ?>;
            var dormRating = <?php echo json_encode($_SESSION['dormRating']); ?>;

            var table = $('#searchTable').DataTable({
                dom:  '<"search">flrtip',
//                columnDefs: [
//                    {
//                        targets: 0,
//                        render: function (data, type, full, meta) {
//                            if(full['TS_'+dormID].newStatus == null)
//                                return '<a href="dormProfile.php?dormID='+dormID+'&pageName=dormDetailedView&wp='+full['TI_'+dormID].workPermit+'">'+data+'</a>';
//                        }
//                    }
//                ],
                order: [ 4, 'asc' ],
                lengthMenu: [[10, 25, 50, 100, 250, -1], [10, 25, 50, 100, 250, "All"]],
//                search: { search: searchText },

                "fnInitComplete": function(oSettings, json) {
                    tableFilter();
                }
            } );

            for (var i = 0; i < dormName.length; i++) {
                table.row.add([dormName[i], dormAddress[i], dormPricing[i], dormCap[i], dormRating[i]]).draw();

//                    if (isExpiring(busInfo[i][2])) {
//                        $(table.cell(tableRowCount, 3).node()).addClass('pinkHighlight');
////                            $('td', table.row(tableRowCount)).eq(3).addClass('pinkHighlight');
//                    }
            }

            $.fn.dataTable.ext.errMode = 'throw';

//            if(screen.width > 1200)
//                $("div.search").html('<img src="images/magnifier.png" class="col-md-offset-9" style="position:relative;top: 25px;">');
//            else
//                $("div.search").html('<img src="images/magnifier.png" class="col-md-offset-8" style="position:relative;top: 23px;">');

            setInterval(function() {
//                tableReload();}, 15000
            });

//            function tableReload(){
//                var tabletools = TableTools.fnGetInstance( table.table().node() );
//                var selectedRows = tabletools.fnGetSelectedIndexes();
//
//                table.ajax.reload(function ( json ){
//                    tableFilter();
//
//                    for(i = 0; i < selectedRows.length; i++){
//                        tabletools.fnSelect( table.row(selectedRows[i]).node() );
//                    }
//                }, false);
//            }

            function tableFilter () {
            }
        } );
    </script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    <!--[endif]-->
</head>

<body>
<div id="header"></div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">
                <span> Search Results</span>
            </h1>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="table-responsive">
                <table id="searchTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Dormitory Name</th>
                        <th>Address</th>
                        <th>Pricing</th>
                        <th>Availability</th>
                        <th>Rating</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="footer"></div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<!--<script src="bootstrap/js/bootstrap.min.js"></script>-->
<!--&lt;!&ndash; IE10 viewport hack for Surface/desktop Windows 8 bug &ndash;&gt;-->
<!--<script src="bootstrap/js/ie10-viewport-bug-workaround.js"></script>-->
</body>
</html>
