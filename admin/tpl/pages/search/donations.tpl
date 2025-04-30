<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/search.js"></script>
<script language="javascript" src="tpl/js/Chart.min.js"></script>
<div class="contentheader">
    Admin Panel > Statistics > Donations<br /><br /><br />
    <span>Donations</span><br /><br />
</div>

<div class="content">

    <div align="center">
        <canvas id="last24hchart" height="300" width="800"></canvas><br />
    </div>
    <script>
        var lineChartData = {
            labels: {chartlabel},
            datasets: [
                {
                    label: "My Second dataset",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: {chartdata}
                }
            ]

        }

        var ctx = document.getElementById("last24hchart").getContext("2d");
        window.myLine = new Chart(ctx).Line(lineChartData, {scaleBeginAtZero : true});
    </script>

    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->

</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->