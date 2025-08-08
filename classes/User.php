<?php

class User {
    public $id;
    public $name;
    public $email;
    public $password;
    public $created_at;

    public function __construct($name, $email, $password, $id = null, $created_at = null) {
        $this->name = htmlspecialchars($name);
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $this->password = $password;
        $this->id = $id ?? time(); // unique id from timestamp
        $this->created_at = $created_at ?? date("Y-m-d H:i:s");
    }

    public function isValid(&$errors, $users) {
        $errors = [];

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (!empty($this->password) && strlen($this->password) < 6) {
            $errors[] = "Password must be at least 6 characters.";
        }

        foreach ($users as $u) {
            if ($u->email === $this->email && $u->id != $this->id) {
                $errors[] = "Email already exists.";
                break;
            }
        }

        return empty($errors);
    }
}
