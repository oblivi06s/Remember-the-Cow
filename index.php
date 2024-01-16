<?php
    include "top.html";
	session_start();

	if (isset($_SESSION["name"])) {
    header("Location: todolist.php");
    exit;
}
?>

    <div id="main">
		<p>
			The best way to manage your tasks. <br />
			Never forget the cow (or anything else) again!
		</p>

		<p>
			Log in now to manage your to-do list:
		</p>

		<form id="loginform" action="login.php" method="post">
			<div>
				<input id="name" name="name" type="text" size="12" autofocus="autofocus" /> <strong>User Name</strong>
			</div>
			<div>
				<input id="password" name="password" type="password" size="12" /> <strong>Password</strong>
			</div>
			<div>
				<input id="submitbutton" type="submit" value="Log in" />
			</div>
		</form>

		<?php
        //session_start();

        if (isset($_SESSION["failed"])) {
            ?>

            <div id="error">
                Incorrect user name / password. Please try again.
            </div>

        <?php
            session_destroy();
        } 
		?>
	</div>  


<?php
	include "bottom.html";
?>