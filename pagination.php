<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./pagination.css">
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <table id="data">
        <tr>
            <td>Row 1</td>
        </tr>
        <tr>
            <td>Row 2</td>
        </tr>
        <tr>
            <td>Row 3 </td>
        </tr>
        <tr>
            <td>Row 4</td>
        </tr>
        <tr>
            <td>Row 5</td>
        </tr>
        <tr>
            <td>Row 6</td>
        </tr>
        <tr>
            <td>Row 7</td>
        </tr>
        <tr>
            <td>Row 8</td>
        </tr>
        <tr>
            <td>Row 9</td>
        </tr>
        <tr>
            <td>Row 10</td>
        </tr>
        <tr>
            <td>Row 11</td>
        </tr>
        <tr>
            <td>Row 12</td>
        </tr>
        <tr>
            <td>Row 13</td>
        </tr>
        <tr>
            <td>Row 14</td>
        </tr>
        <tr>
            <td>Row 15</td>
        </tr>
        <tr>
            <td>Row 16</td>
        </tr>
        <tr>
            <td>Row 17</td>
        </tr>
        <tr>
            <td>Row 18</td>
        </tr>
        <tr>
            <td>Row 19</td>
        </tr>
        <tr>
            <td>Row 20</td>
        </tr>
        <tr>
            <td>Row 21</td>
        </tr>
        <tr>
            <td>Row 22</td>
        </tr>
        <tr>
            <td>Row 23</td>
        </tr>
        <tr>
            <td>Row 24</td>
        </tr>
        <tr>
            <td>Row 25</td>
        </tr>
        <tr>
            <td>Row 26</td>
        </tr>
    </table>
    <script>

        $(document).ready(function () {
            $('#data').after('<div id="nav"></div>');
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
                }, 300);
            }); 
            function pagination(){
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