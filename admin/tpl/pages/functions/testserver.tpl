<!-- START BLOCK : showpage -->
<div class="contentheader">
    Admin Panel > Settings > Test Server > Create Account<br /><br /><br />
    <span>Create Account</span><br /><br />
</div>

<div class="content">
    
    <p>To start playing on the testserver you need to do the following:</p>
    <ul>
        <li>Download the TestServer Client by clicking <a href="http://download.lhgenericname01.lc/LHGenericName01-Test.exe">here</a> and unpack it where you want</li>
        <li>Create a game account below</li>
    </ul>
    
    <p>All testserver accounts have a lot of cash and when you create a new character it is GM level 11</p>
        
    <form method="post" action="testserver.php" class="stdform">
    <table>
        <tr>
            <td>Username</td>
            <td><input type="text" name="username" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="password" /> (don't use your real password)</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" value="Create TestServer Account" />
                <input type="hidden" name="action" value="ctsa" />
            </td>
        </tr>
    </table>
    </form>
    
    <hr size="1" />
    <h2>My testserver accounts</h2>
    <table class="filltable">
        <tr>
            <th width="200">Username</th>
            <th>Password</th>
        </tr>
        <!-- START BLOCK : accountlist -->
        <tr>
            <td>{username}</td>
            <td>{password}</td>
        </tr>
        <!-- END BLOCK : accountlist -->
    </table>

    <!-- START BLOCK : error -->
    {msg}
    <!-- END BLOCK : error -->

</div>
<!-- END BLOCK : showpage -->

<!-- INCLUDE BLOCK : noperm -->