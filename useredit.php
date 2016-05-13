<?php
/**
 * UserEdit.php
 *
 * This page is for users to edit their account information
 * such as their password, email address, etc. Their
 * usernames can not be edited. When changing their
 * password, they must first confirm their current password.

 */
include("include/classes/session.php");
?>

<html>
<title>Cyber Login Script</title>
<body>

<?php
/**
 * User has submitted form without errors and master's
 * account has been edited successfully.
 */
if(isset($_SESSION['useredit'])){
    unset($_SESSION['useredit']);

    echo "<h1>User Account Edit Success!</h1>";
    echo "<p><b>$session->username</b>, your account has been successfully updated. "
        ."<a href=\"index.php\">Main</a>.</p>";
}
else{
    ?>

    <?php
    /**
     * If master is not logged in, then do not display anything.
     * If master is logged in, then display the form to edit
     * account information, with the current email address
     * already in the field.
     */
    if($session->logged_in){
        ?>

        <h1>User Account Edit : <?php echo $session->username; ?></h1>
        <?php
        if($form->num_errors > 0){
            echo "<td><font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font></td>";
        }
        ?>
        <form action="process.php" method="POST">
            <table align="left" border="0" cellspacing="0" cellpadding="3">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="curpass" maxlength="30" value="
<?php echo $form->value("curpass"); ?>"></td>
                    <td><?php echo $form->error("curpass"); ?></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="newpass" maxlength="30" value="
<?php echo $form->value("newpass"); ?>"></td>
                    <td><?php echo $form->error("newpass"); ?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="email" maxlength="50" value="
<?php
                        if($form->value("email") == ""){
                            echo $session->userinfo['email'];
                        }else{
                            echo $form->value("email");
                        }
                        ?>">
                    </td>
                    <td><?php echo $form->error("email"); ?></td>
                </tr>
                <tr><td colspan="2" align="right">
                        <input type="hidden" name="subedit" value="1">
                        <input type="submit" value="Edit Account"></td></tr>
                <tr><td colspan="2" align="left"></td></tr>
            </table>
            <a href="login.php">Return to main</a>
        </form>

        <?php
    }
}

?>

</body>
</html>