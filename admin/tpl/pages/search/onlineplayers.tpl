<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/search.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script language="javascript" src="tpl/js/Chart.min.js"></script>
<!-- START BLOCK : chart -->
<script>
    var lineChartData = {
        labels: {date_json},
        datasets: [
            {
                label: "My Second dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: {total_json}
            }
        ]
    }
        
    var ctx = document.getElementById("last24hchart").getContext("2d");
    window.myLine = new Chart(ctx).Line(lineChartData, {scaleBeginAtZero : true});    

    
</script>
<!-- END BLOCK : chart -->

<div class="contentheader">
    Admin Panel > Statistics > Online Players<br /><br /><br />
    <span>Online Players</span><br /><br />
</div>

<div class="content">
    
    <h2>Players Online: {total}</h2>
    <table cellspacing="0" style="width:700px; margin: 0 auto;">
        <tr>
            <td colspan="3">
                <canvas width="700" height="150px" id="last24hchart"></canvas>
                <br />
                <br />
            </td>
        </tr>
        <tr>
            <td valign="top" width="48%">
                <!-- START BLOCK : channel1 -->
                <table cellspacing="0" cellpadding="2" width="100%">  
                    <tr>
                        <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 2px 0 1px; font-size:14px; font-weight:bold; text-align:left;" colspan="5">Players online on Channel 1: {chan1}</td>
                    </tr>
                    <!-- START BLOCK : zone -->
                    <tr>
                        <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 2px 0 1px; font-size:12px; font-weight:bold; text-align:left;" colspan="5">{zone}</td>
                    </tr>
                    <!-- START BLOCK : char -->
                    <tr>
                        <td style="{color} {bgimg} border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:10px; width:10px;">&nbsp;</td>
                        <td style="{color} border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:10px; width:55px;">{id}</td>
                        <td style="{color} border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:10px;"><a href="{url}">{name}</td>
                        <td style="{color} border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:10px; width:35px;">{level}</td>
                        <td style="{color} border:1px solid #cccccc; border-width:1px 2px 0 1px; font-size:10px; width:80px;">{class}</td>
                    </tr>
                    <!-- END BLOCK : char -->
                    <!-- END BLOCK : zone -->
                    <tr>
                        <th style="border:1px solid #cccccc; border-width:1px 0 0 0; font-size:11px; font-weight:bold; text-align:left;" colspan="5">&nbsp;</td>
                    </tr>       
                </table>
                <!-- END BLOCK : channel1 -->
            </td>
            <td>&nbsp;</td>
            <td valign="top" width="48%">
                <!-- START BLOCK : channel2 -->
                <table cellspacing="0" cellpadding="2" width="100%">        
                    <tr>
                        <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 2px 0 1px; font-size:14px; font-weight:bold; text-align:left;" colspan="5">Players online on Channel 2: {chan2}</td>
                    </tr>
                    <!-- START BLOCK : zone2 -->
                    <tr>
                        <td style="background-color: #f0f0f0; border:1px solid #cccccc; border-width:1px 2px 0 1px; font-size:12px; font-weight:bold; text-align:left;" colspan="5">{zone}</td>
                    </tr>
                    <!-- START BLOCK : char2 -->
                    <tr>
                        <td style="{color} {bgimg} border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:10px; width:10px;">&nbsp;</td>
                        <td style="{color} border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:10px; width:55px;">{id}</td>
                        <td style="{color} border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:10px;"><a href="{url}">{name}</td>
                        <td style="{color} border:1px solid #cccccc; border-width:1px 0 0 1px; font-size:10px; width:35px;">{level}</td>
                        <td style="{color} border:1px solid #cccccc; border-width:1px 2px 0 1px; font-size:10px; width:80px;">{class}</td>
                    </tr>
                    <!-- END BLOCK : char2 -->
                    <!-- END BLOCK : zone2 -->
                    <tr>
                        <th style="border:1px solid #cccccc; border-width:1px 0 0 0; font-size:11px; font-weight:bold; text-align:left;" colspan="5">&nbsp;</td>
                    </tr>       
                </table>
                <!-- END BLOCK : channel2 -->
            </td>
        </tr>
    </table>


    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->

</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->