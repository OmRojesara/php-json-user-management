<?php

class UserRepository 
{
    private $file = 'data/users.json';

    public function getAllUsers() 
    {
        if (!file_exists($this->file)) 
        {
            return [];
        }
        $data = json_decode(file_get_contents($this->file));
        return $data ?? [];
    }

    public function saveAllUsers($users) 
    {
        file_put_contents($this->file, json_encode($users, JSON_PRETTY_PRINT));
    }

    public function findById($id) 
    {
        $users = $this->getAllUsers();
        foreach ($users as $user) 
        {
            if ($user->id == $id) 
            {
                return $user;
            }
        }
        return null;
    }

    public function addUser($user) 
    {
        $users = $this->getAllUsers();
        $users[] = $user;
        $this->saveAllUsers($users);
    }

    public function updateUser($updatedUser) 
    {
        $users = $this->getAllUsers();
        foreach ($users as &$user) {
            if ($user->id == $updatedUser->id) 
            {
                $user->name = $updatedUser->name;
                $user->email = $updatedUser->email;
                if (!empty($updatedUser->password)) 
                {
                    $user->password = $updatedUser->password;
                }
                break;
            }
        }
        $this->saveAllUsers($users);
    }

    public function deleteUser($id) 
    {
        $users = $this->getAllUsers();
        $users = array_filter($users, fn($user) => $user->id != $id);
        $this->saveAllUsers(array_values($users));
    }
}
