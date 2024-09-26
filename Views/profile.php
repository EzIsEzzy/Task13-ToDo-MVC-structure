<?php 
if(isset($_COOKIE['TODO_USER']) && !empty($_COOKIE['TODO_USER'])) {
    $user = json_decode($_COOKIE['TODO_USER'] , true);
}
include "htmlhead.php"; ?>
<!-- start of main -->
<main id="register">
    <!-- start of Register section -->
    <section>
        <a href="./homepage"><img src="./assets/images/back-button.png" alt="back_button" width="50px" height="50px"></a>
        <?php echo '<img src="'. $user['picture'] .'" id="profile" alt="">'?>
        <br>
        <h1>Update Profile</h1>
        <br>
            <form action="./updateprofile?id=<?php echo $user['id'] ?>" method="post" enctype="multipart/form-data">
                <br>
                <input type="text" name="firstname" id="input" placeholder="Enter your First name" value="<?php echo $user['firstName'] ?>" >
                <input type="text" name="lastname" id="input" placeholder="Enter your Last name" value="<?php echo $user['lastName'] ?>" >
                <input type="text" name="password" id="input" placeholder="Enter your new password" >
                <input type="text" name="passwordconfirm" id="input" placeholder="Confirm your new password" >
                <input type="email" name="email" id="input" placeholder="Enter your Email" value="<?php echo $user['email'] ?>" >
                <br>
                <div>
                    <label for="file">Profile Picture: </label>
                    <input type="file" name="image" id="file" value="<?php echo $user['picture'] ?>" >
                </div>
                <br>
                <input type="submit" name="sendData" id="submit" value="Update Profile">
            </form>
            <?php
                if (isset($_SESSION["Error"])){
                    echo "<p style='background-color: red; padding:10px; color:white; border-radius:5px; margin:10px'>".$_SESSION['Error']."</p>";

                    unset($_SESSION["Error"]);
                }
            ?>
    </section>
    <!-- end of Register section -->
    </main>
    <!-- end of main -->
<?php include "htmlfoot.php" ?>