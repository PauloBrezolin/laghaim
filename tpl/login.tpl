<form method="post" action="index.php">
    <table id="logintable">
        <tr>
            <td>Username</td>
            <td><input type="text" name="log_uname" size="18"/></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="log_pw" size="18" /></td>
        </tr>
        <tr>
            <td><img src="verification.php" /></td>
            <td><input type="text" name="log_code" size="4" /></td>
        </tr>
    </table>
    <br />
    <input type="submit" value="Login" />
    <input type="hidden" name="action" value="login" />
</form>