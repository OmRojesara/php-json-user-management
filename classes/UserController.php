<?php

class UserController 
{
    private $repo;

    public function __construct() 
    {
        $this->repo = new UserRepository();
    }

    
    public function showLoginForm() 
    {
        $error = '';
        include 'views/login.php';
    }

    public function doLogin() 
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $users = $this->repo->getAllUsers();

        foreach ($users as $user) 
        {
            if ($user->email === $email && password_verify($password, $user->password)) 
            {
                $_SESSION['user'] = $user;
                header("Location: index.php");
                return;
            }
        }

        $error = "Invalid email or password.";
        include 'views/login.php';
    }

    public function logout() 
    {
        session_destroy();
        header("Location: index.php");
    }

    public function showRegisterForm() 
    {
        $errors = [];
        include 'views/register.php';
    }

    public function doRegister() 
    {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $user = new User($name, $email, $hashed);
        $existingUsers = $this->repo->getAllUsers();

        if ($user->isValid($errors, $existingUsers)) 
        {
            $this->repo->addUser($user);
            $_SESSION['user'] = $user;
            header("Location: index.php");
        }
        else 
        {
            include 'views/register.php';
        }
    }

    public function listUsers() 
    {
        $users = $this->repo->getAllUsers();

        $query = $_GET['search'] ?? '';
    
        if (!empty($query)) {
            $query = strtolower($query);
            $users = array_filter($users, function ($user) use ($query) 
            {
                return strpos(strtolower($user->name), $query) !== false ||
                       strpos(strtolower($user->email), $query) !== false;
            });
        }

        include 'views/user_list.php';
    }

    public function addUser() 
    {
        include 'views/add_user_form.php';
    }

    public function storeUser() 
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $user = new User($name, $email, $hashed);
        $existingUsers = $this->repo->getAllUsers();

        if ($user->isValid($errors, $existingUsers)) 
        {
            $this->repo->addUser($user);
            header("Location: index.php");
        } 
        else
        {
            include 'views/add_user_form.php';
        }
    }

    public function editUser() 
    {
        $id = $_GET['id'];
        $user = $this->repo->findById($id);
        include 'views/edit_user_form.php';
    }

    public function updateUser() 
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User($name, $email, '', $id);
        $existingUsers = $this->repo->getAllUsers();

        if (!empty($password)) 
        {
            $user->password = password_hash($password, PASSWORD_BCRYPT);
        }

        if ($user->isValid($errors, $existingUsers)) 
        {
            $this->repo->updateUser($user);
            header("Location: index.php");
        }
        else 
        {
            $userData = $this->repo->findById($id);
            include 'views/edit_user_form.php';
        }
    }

    public function deleteUser() 
    {
        $id = $_GET['id'];
        $this->repo->deleteUser($id);
        header("Location: index.php");
    }

    public function viewUser() 
    {
        $id = $_GET['id'];
        $user = $this->repo->findById($id);
        include 'views/view_user.php';
    }
}
