<?php
include_once './Models/DB.php';
class NotesController{
    public static function Login()
    {
        $Login = new ModelDB('users');
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!($email && $password)) {
            $_SESSION['error'] = 'Email & Password are required !';
            header(header: 'Location: ' . $_SERVER['HTTP_REFERER']); // return back
            exit();
        }
        $user = $Login->onlyFirst('email',$email);
        if($user){
            if(password_verify($password,$user['password'])){
                unset ($user['password']);
                setcookie('TODO_USER',json_encode($user),time() + 24 * 60 * 60,'/');
                $_SESSION['success'] = 'Login Successful!';
                header('location: ./homepage');
                exit();
            }
            else{
                $_SESSION['error'] = 'Email is invalid !';
                header('Location: ' . $_SERVER['HTTP_REFERER']); // return back
                exit();
            }
        }
    }
    public static function Register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $file = new Files;
            $register = new ModelDB("users");
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];


            // if(empty($firstname) or empty($lastname))
            // {
            //     $_SESSION['Error'] = 'First and Last name is required!';
            //     header('location: ../frontpages/register.php');
            //     exit();
            // }
            // if (!$password)
            // {
            //     $_SESSION['Error'] = 'Password is required!';
            //     header('location: ../frontpages/register.php');
            //     exit();
            // }
            if ($_POST['password'] === $_POST['passwordconfirm'])
                {
                    $password = password_hash( $_POST['password'], PASSWORD_DEFAULT);
                }
            else
                {
                    $_SESSION['Error'] = 'Passwords do not match!';
                    header('location: ./register');
                    exit();
                }
            // if(!$email)
            // {
            //     $_SESSION['Error'] = 'Email is required';
            //     header('location: ../frontpages/register.php');
            //     exit();
            // }
            $data = [
                        'firstName' => $firstname,
                        'lastName' => $lastname,
                        'password' => $password,
                        'email'=> $email,
                        'picture' => ''
                    ];
                    if(!empty($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
                        $profile = $file->upload($_FILES['image']);
                        $data['picture'] = $profile;
                    }
                    if (!file_exists($data['picture'])) $data['picture'] = '../assets/profiles/default.png';

            if($register->insertValues($data))
            {
                $user = $register->onlyFirst('email',$email);
                unset ($user['password']);
                $_SESSION['Success'] = 'Registered Successfully';
                setcookie('TODO_USER',json_encode($user),time() + 24 * 60 * 60,'/');
                header((string)'location: ./homepage');
            }
        }
    }
    public static function Logout(){
        setcookie('TODO_USER', '', time() - 24 * 60 * 60,'/');
        header('location: ./');
    }
    public static function AddNote()
    {
        if(isset($_COOKIE['TODO_USER']) && !empty($_COOKIE['TODO_USER'])) {
            $user = json_decode($_COOKIE['TODO_USER'] , true);
        }
        else{
            header('location: ./');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $note = new ModelDB("notes");
            $title = $_POST['title'];
            $description = $_POST['desc'];
            $note_date = $_POST['date'];
            $done = $_POST['done'];
            $user_id = $user['id'];

            $data = [
                'title' => $title,
                'description'=> $description,
                'note_date' => $note_date,
                'done' => $done,
                'user_id' => $user_id
            ];
            print_r($note->insertValues($data));
            header('location: ./homepage');
        }

    }
    public static function UpdateNote()
    {
        if(isset($_COOKIE['TODO_USER']) && !empty($_COOKIE['TODO_USER'])) {
            $user = json_decode($_COOKIE['TODO_USER'] , true);
        }
        else{
            header('location: ./');
        }
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $id = $_GET['id'];
            $note = new ModelDB("notes");
            $title = $_POST['title'];
            $description = $_POST['desc'];
            $note_date = $_POST['date'];
            $done = $_POST['done'];
        
            $data = [
                'title' => $title,
                'description'=> $description,
                'note_date' => $note_date,
                'done' => $done,
            ];
            print_r($note->updateValues($data,'id',$id));
            header('location: ./homepage');
        }
        
    }
    public static function DeleteNote()
    {
        if(isset($_COOKIE['TODO_USER']) && !empty($_COOKIE['TODO_USER'])) {
            $user = json_decode($_COOKIE['TODO_USER'] , true);
        }
        else{
            header('location: ./');
        }
        session_start();
        $id = $_GET['id'];
        $noteDelete = new ModelDB('notes');
        if($noteDelete->deleteValues($id))
        {
            header('location:./homepage');
            $_SESSION ['success'] = 'Deleted Successfully!';
        }
    }
    public static function UpdateProfile()
    {
        if(isset($_COOKIE['TODO_USER']) && !empty($_COOKIE['TODO_USER'])) {
            $user = json_decode($_COOKIE['TODO_USER'] , true);
        }
        else{
            header('location: ../index.php');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $file = new Files;
            $updateProfile = new ModelDB("users");
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            if ($_POST['password'] === $_POST['passwordconfirm'])
            {
                $password =password_hash( $_POST['password'], PASSWORD_DEFAULT);
            }
            else
            {
                $_SESSION['Error'] = 'Passwords do not match!';
                header('location: ./profile');
                exit();
            }
            $data = [
                        'firstName' => $firstname,
                        'lastName' => $lastname,
                        'password' => $password,
                        'email'=> $email,
                        'picture' => ''
                    ];
            if(file_exists($user['picture']))
            {
                if ($user['picture'] != './assets/profiles/default.png')
                    {
                        $file->remove($user['picture']);
                        $data['picture'] = './assets/profiles/default.png';
                    }
                if(!empty($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
                    $profile = $file->upload($_FILES['image']);
                    $data['picture'] = $profile;
                }
            }  
            if($updateProfile->updateValues($data, 'id', $user['id']))
            {
                unset ($data['password']);
                $updated_user = $updateProfile->onlyFirst('email',$email);
                if($updated_user)
                {
                    setcookie('TODO_USER', '', time() - 24 * 60 * 60,'/');
                    $_SESSION['Success'] = 'Updated Successfully';
                    unset($updated_user['password']);
                    setcookie('TODO_USER',json_encode($updated_user),time() + 24 * 60 * 60,'/');
                    header('location: ./homepage');
                }
            }
        }        
    }
}