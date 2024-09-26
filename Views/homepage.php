<?php
if(isset($_COOKIE['TODO_USER']) && !empty($_COOKIE['TODO_USER'])) {
    $user = json_decode($_COOKIE['TODO_USER'] , true);
}
else{
    header('location: ./');
}
include "header.php";

$notes = new ModelDB('notes');
?>
    <!-- start of main -->
    <main id="main">
        <!-- start of hero -->
        <section class="hero">
            <div class="hero_text">
                <h1><?php echo 'Hello, '. $user['firstName'].' '.$user['lastName'] ?></h1>
                <h2>Check your Notes here!</h2>
                <div>
                    <br>
                    <a href="./notepage">Add your Note!</a>
                </div>
            </div>
            <div class="notes">
            <table>
                <thead>
                    <tr class="header">
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Note Date</th>
                        <th>Done</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($notes->All_singleUser('user_id', $user['id'])) > 0) {
                        foreach ($notes->All() as $row){
                        $text = '<tr><td>';
                        $text .= $row['id'];
                        $text .= '</td> <td>';
                        $text .= $row['title'];
                        $text .= '</td> <td>';
                        $text .= $row['description'];
                        $text .= '</td> <td>';
                        $text .= $row['note_date'];
                        $text .= '</td> <td>';
                        if($row['done'] == (bool)1)
                            $text .= 'Done!';
                        if($row['done'] == (bool)0)
                            $text .= 'Not Done!';
                        $text .= "</td><td><a href='./noteupdate?id=".$row['id']."'>Update</a></td><td><a href='./notedelete?id=".$row['id']."'>Delete</a></td></tr>";
                        echo $text;
                        }
                    }
                    else{
                        $text = "<tr><td colspan='6'> No Records! </td></tr>";
                        echo $text;
                    }
                    ?>
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