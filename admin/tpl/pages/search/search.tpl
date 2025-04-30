<!-- START BLOCK : showpage -->
<script language="javascript" src="tpl/js/search.js"></script>
<div class="contentheader">
    Search > {searchtype_text}<br /><br /><br />
    <span>Find {searchtype_text}</span><br /><br />
</div>
                        
<div class="content">
    
    <div id="searchcontainer">
        <form id="searchform">
            {searchtype_text}: <input type="text" name="value" id="value" size="40" /> <input type="submit" value="Search" /><br />
            <!--<input type="checkbox" name="case" value="yes" /> Case Sensitive-->
            <input type="hidden" name="action" value="{form_action}" />
        </form>
    </div>
    
    <div id="searchresult">
    </div>
    
    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->
    
</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->