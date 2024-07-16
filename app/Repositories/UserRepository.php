<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getByEmail($email)
    {
        return $this->user->where('email', $email)->first();
    }

    public function store($data)
    {
        return $this->user->create($data);
    }

    public function update($id, $data)
    {
        return $this->user->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->user->find($id)->delete();
    }
}
