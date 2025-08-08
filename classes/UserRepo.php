<?php

require_once 'User.php';

class UserRepo 
{
    private $file = 'data/users.json';

    function all() 
    {
        $content = file_get_contents($this->file);
        return json_decode($content, true);
    }

    function save($users) 
    {
        file_put_contents($this->file, json_encode($users, JSON_PRETTY_PRINT));
    }

    function get($id) 
    {
        foreach ($this->all() as $u) 
        {
            if ($u['id'] == $id) return $u;
        }
        return null;
    }

    function add(User $user) 
    {
        $users = $this->all();

        foreach ($users as $u) 
        {
            if ($u['email'] === $user->email) 
            {
                return "Email already used.";
            }
        }

        $user->id = Helper::nextId($users);
        $user->password = password_hash($user->password, PASSWORD_BCRYPT);
        $users[] = $user->toArray();
        $this->save($users);
        return true;
    }

    function remove($id) 
    {
        $all = $this->all();
        $all = array_filter($all, fn($u) => $u['id'] != $id);
        $this->save(array_values($all));
    }
}
