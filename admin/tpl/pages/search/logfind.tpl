<!-- START BLOCK : showpage -->
<script src="tpl/js/acpv2.js"></script>
<script>
    function showMore()
    {
        $('.hidden').toggle();
    }
</script>
<div class="contentheader">
    Admin Panel > Search > In Logfiles<br /><br /><br />
    <span>Search Logfile</span><br /><br />
</div>
                        
<div class="content">
    
    <table class="filltable">
        <tr>
            <th>GM</th>
            <th>Date</th>
            <th>Search</th>
            <th>Status</th>
            <th>Download</th>
            <th>Filesize</th>
            <th>Password</th>
        </tr>
        
        <!-- START BLOCK : list -->
        <tr {showhide}>
            <td>{gm}</td>
            <td>{date}</td>
            <td>{search}</td>
            <td>{status}</td>
            <td>{download}</td>
            <td>{size} kb</td>
            <td>{password}</td>
        </tr>
        <!-- END BLOCK : list -->
        
    </table>
        <br />
        <a href="javascript: showMore();">Show more</a>
        
    <hr size="1" />
    <h2>New search</h2>
    <p>Please don't use this function just for fun, only use it when its really needed.<br />Search smart, dont search for things that will give thousands of results because the file will be huge.<br />Just enter the text to search and press Find.<br />It could take up to 15 minutes for the log searching to complete, when it is done it will show on this page, just refresh it now and then</p>
    <form method="post" action="logfind.php" class="stdform">
        Find Text: <input type="text" name="find" /> <input type="submit" value="Find" /><input type="hidden" name="action" value="findlog" />
    </form>
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->