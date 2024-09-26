<?php include "htmlhead.php"; ?>
<!-- start of main -->
<main id="register">
    <!-- start of Register section -->
    <section>
        <a href="./"><img src="./assets/images/back-button.png" alt="back_button" width="50px" height="50px"></a>
        <h1>TODO App</h1>
        <br>
            <form action="./register_back" method="post" enctype="multipart/form-data">
                <h2>Register Info</h2>
                <br>
                <input type="text" name="firstname" id="input" placeholder="Enter your First name" >
                <input type="text" name="lastname" id="input" placeholder="Enter your Last name" >
                <input type="password" name="password" id="input" placeholder="Enter your password" >
                <input type="password" name="passwordconfirm" id="input" placeholder="Confirm your password" >
                <input type="email" name="email" id="input" placeholder="Enter your Email" >
                <br>
                <div>
                    <label for="file">Profile Picture: </label>
                    <input type="file" name="image" id="file" >
                </div>
                <br>
                <input type="submit" name="sendData" id="submit" value="Register">
            </form>
            <?php
                if (isset($_SESSION["Error"])){
                    echo "<p style='background-color: red; padding:10px; color:white; border-radius:5px; margin:10px'>".$_SESSION['Error']."</p>";
                }
            ?>
    </section>
    <!-- end of Register section -->
    </main>
    <!-- end of main -->
<?php include "htmlfoot.php" ?>