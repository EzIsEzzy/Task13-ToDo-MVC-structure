<?php include "htmlhead.php"; ?>
<!-- start of main -->
<main id="register">
    <!-- start of Login section -->
    <section>
        <a href="./"><img src="./assets/images/back-button.png" alt="back_button" width="50px" height="50px"></a>
        <h1>TODO App</h1>
        <br>
        <form action="./login_back" method="post">
            <h2>Login Info</h2>
            <br>
            <input type="email" name="email" id="input" placeholder="Enter your Email" required>
            <input type="password" name="password" id="input" placeholder="Enter your password" required>            
            <br>
            <input type="submit" name="sendData" id="submit" value="Register">
        </form>
        <?php
            // if (isset($_SESSION["Error"])){
            //     echo "<p style='background-color: red; padding:10px; color:white; border-radius:5px; margin:10px'>".$_SESSION['Error']."</p>";
            // }
        ?>
    </section>
    <!-- end of Login section -->
    </main>
    <!-- end of main -->
<?php include "htmlfoot.php" ?>