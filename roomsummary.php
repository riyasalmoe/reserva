<?php
    include('xmlreader.php');

    if(!isset($_GET['floor'])){exit;}

    $page = $_SERVER['PHP_SELF'] . "?floor=" . $_GET['floor'];
    //$page = $_SERVER['REQUEST_URI'];
    $sec = "900"; //page refresh interval in seconds.
    header("Refresh: $sec; url=$page");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./myclass.css">

    <script src="./node_modules/jquery/dist/jquery.js"></script>
    <script src="./node_modules/popper.js"></script>
    <script src="./node_modules/moment/moment.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <title>Meeting Room Summary</title>
</head>
<body class="dimension">
<div class="row">
    <div class="col-lg-4">
        <div class="date" id='date-part'></div>
        <br>
        <div class="time" id='time-part'></div>
    </div>
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <img src="./img/RTA-Logo.png" class="logo" alt="">
    </div>
</div>
<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="tablepadd">
        <table class="table" id="data">
            <thead>
                <tr>
                    <th class='tdstyle text-left'>Start Time</th>
                    <th class='tdstyle text-center'>Meeting Subject</th>
                    <th class='tdstyle text-right vert-align_th'>Meeting Room</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $rooms = read_resources($_GET['floor']);
                    if(count($rooms)>0){
                        $arrlength = count($rooms);
                        for($x = 0; $x < $arrlength; $x++) {
                            xmlreader_getMeetings("./xml/$rooms[$x].xml");
                        }
                    }
                ?>
            </tbody>
        </table>
        </div>
    <hr>
    <hr>
    </div>
    <div class="col-lg-1"></div>
</div>

<script>
    
    $(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('dddd').substring(0,1).toUpperCase() +
                             momentNow.format('dddd').substring(1,3) + ', '
                             + momentNow.format('MMM DD YYYY'));
        $('#time-part').html(momentNow.format('hh:mm:ss A'));
    }, 100);  

//pagination process
$('#data').after('<div id="nav" style="display:none;"></div>');
            var p=1;
            var imax = 3;
            var time = 3000;
            var rowsShown = 4;
            var rowsTotal = $('#data tbody tr').length;
            var numPages = rowsTotal / rowsShown;
            for (i = 0; i < numPages; i++) {
                var pageNum = i + 1;
                $('#nav').append('<a href="#" id="Page' + pageNum + '" rel="' + i + '">' + pageNum + '</a> ');
            }
            $('#data tbody tr').hide();
            $('#data tbody tr').slice(0, rowsShown).show();
            $('#nav a:first').addClass('active');
            $('#nav a').bind('click', function () {

                $('#nav a').removeClass('active');
                $(this).addClass('active');
                var currPage = $(this).attr('rel');
                var startItem = currPage * rowsShown;
                var endItem = startItem + rowsShown;
                $('#data tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
                css('display', 'table-row').animate({
                    opacity: 1
                }, 600);
            }); 
            function pagination(){
                if(numPages<1){return;}
                setTimeout(function(){
                    $('#Page' + p).trigger('click');
                    if(p>=numPages){p=1;}else{p++;}
                    //alert(p);
                    pagination();
                },time);}
                pagination();
});    
    
    </script>
</body>
</html>