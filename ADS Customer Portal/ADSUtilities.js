function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

function formatDateTime( dateTime ){
    date = dateTime.substr(0,10).split('-');
    time = dateTime.substr(11);
    return date[2] + '-' + date[1] + '-' + date[0] + ", " + time;
}

function formatTimeDate( dateTime ){
    date = dateTime.substr(0,10).split('-');
    time = dateTime.substr(11);
    return time + ", " + date[2] + '-' + date[1] + '-' + date[0];
}

function formatDate( date ){
    date = date.split('-');
    return date[2] + '-' + date[1] + '-' + date[0];
}

function isExpiring( date ){
    var today = new Date();
    today.setDate(today.getDate() + 14);
    var dd = today.getDate();
    var mm = today.getMonth() + 1;

    if(dd<10) {
        dd = '0'+dd;
    }

    if(mm<10) {
        mm = '0'+mm;
    }

    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;

    if(today > date)
        return true;
    else
        return false;
}

function isExpired( date ){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;

    if(dd<10) {
        dd = '0'+dd;
    }

    if(mm<10) {
        mm = '0'+mm;
    }

    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;

    if(today > date)
        return true;
    else
        return false;
}

function isLeapYear( year ){
    return ((year % 4 == 0 && year % 100 != 0) || (year % 400 == 0));
}

function printElem(elem, orientation)
{
    popup($(elem).html(), orientation);
}

function popup(data, orientation)
{
    var mywindow = window.open('', 'Print Barcode', 'height=768,width=1024');
    mywindow.document.write('<html><head><title>Print Details</title>');
    mywindow.document.write('<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">');

    //Set landscape or portrait
    if(orientation == 1){
        mywindow.document.write('<style type="text/css" media="print"> @page { size: landscape; } </style>');
    }

    mywindow.document.write('</head><body>');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10

    mywindow.print();
    mywindow.close();

    return true;
}

function checkCommHistoryAction( result, i ){
    var tmpString = "";

    if (result[1][i] == "ADDED") {
        tmpString = " has <span class=\"greenHighlight\">" + result[1][i] + "</span> " +
        result[3][i] + " " + result[4][i] + " to " + result[2][i];
    }
    else if (result[1][i] == "CHANGED") {
        tmpString = " has <span class=\"orangeHighlight\">" + result[1][i] + "</span> " +
        result[3][i] + " " + result[4][i] + " from " + result[6][i] + " to " +
        result[7][i] + " in " + result[2][i];
    }
    else if (result[1][i] == "REMOVED") {
        tmpString = " has <span class=\"redHighlight\">" + result[1][i] + "</span> " +
        result[3][i] + " " + result[4][i] + " from " + result[2][i];
    }
    else if(result[1][i] == "ALERT"){
        var action = "";
        if(result[6][i] == "Checked-in")
            action = "checked in";
        else
            action = "checked out";

        tmpString = "<span class=\"redHighlight\"> *** ALERT " + result[3][i] + " " + result[4][i] + " has " + action + " ***</span> ";
    }
    else if(result[1][i] == "FLAGGED"){
        tmpString = "<span class=\"redHighlight\">has " + result[1][i] + " " +  result[3][i] + " " + result[4][i] + "</span>";
    }
    else if(result[1][i] == "UNFLAGGED"){
        tmpString = "<span class=\"redHighlight\">has " + result[1][i] + " " + result[3][i] + " " + result[4][i] + "</span>";
    }

    return tmpString;
}