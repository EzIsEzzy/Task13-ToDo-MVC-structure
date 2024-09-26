<?php
if(isset($_COOKIE['TODO_USER']) && !empty($_COOKIE['TODO_USER'])) {
    $user = json_decode($_COOKIE['TODO_USER'] , true);
}
else{
    header('location: ./');
}
include "header.php";
$users = new ModelDB('users');
// $SingeUser = $users->All_singleUser();
$notes = new ModelDB('notes');
?>
    <!-- start of main -->
    <main id="main">
        <!-- start of hero -->
        <section class="hero">
            <div class="hero_text">
                <h1><?php echo 'Create your note, '. $user['firstName'].'! ' ?></h1>
                <h2>Check your Notes here!</h2>
            </div>
            <div class="notes">
            <table>
                <thead>
                    <tr class="header">
                        <th>Title</th>
                        <th>Description</th>
                        <th>Note Date</th>
                        <th>Done</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <form action="./notepage_back" method="post">
                        <td><input type="text" name="title" id="title" required></td>
                        <td><input type="text" name="desc" id="desc" required></td>
                        <td><input type="date" name="date" id="date" required></td>
                        <td><select name="done" id="done" required>
                            <option value="" selected disabled>Select:</option>
                            <option value="0">Not Done!</option>
                            <option value="1">Done!</option>
                        </select></td>
                        <td><input type="submit" name="sendData" value="Create!" id="submit"></td>
                        </form>
                    </tr>
                </tbody>
            </table>
            </div>
        </section>
        <!-- end of hero -->

    </main>
    <!-- end of main -->
<?php
include "footer.php";
?>