<?php
if(isset($_COOKIE['TODO_USER']) && !empty($_COOKIE['TODO_USER'])) {
    $user = json_decode($_COOKIE['TODO_USER'] , true);
}
else{
    header('location: ./');
}
include "header.php";

$showOldNote = new ModelDB('notes');
$id=$_GET['id'];
$OldNote = $showOldNote->onlyFirst('id',$id);
$updateNotes = new ModelDB('notes');
?>
    <!-- start of main -->
    <main id="main">
        <!-- start of hero -->
        <section class="hero">
            <div class="hero_text">
                <h1><?php echo 'Update this note, '. $user['firstName'].'! ' ?></h1>
                <h2>& check on them later!</h2>
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
                        <form action="./noteupdating?id=<?php echo $id ?>" method="post">
                        <td><input type="text" name="title" id="title" value="<?php echo $OldNote['title'] ?>" required></td>
                        <td><input type="text" name="desc" id="desc" value="<?php echo $OldNote['description'] ?>" required></td>
                        <td><input type="date" name="date" id="date" value="<?php echo $OldNote['note_date'] ?>" required></td>
                        <td><select name="done" id="done"   required>
                            <?php 
                            if($OldNote['done'] == 1)
                            {
                                echo '<option value="1" selected disabled>As Done!</option>';
                            }
                            elseif($OldNote['done'] == 0)
                            {
                                echo '<option value="0" selected disabled>As Not Done!</option>';
                            }
                            else{
                                echo '<option value="0">Not Done!</option>';
                                echo '<option value="1">Done!</option>';
                            }
                            ?>
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