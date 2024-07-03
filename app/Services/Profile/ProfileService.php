<?php

namespace App\Services\Profile;

interface ProfileService
{
    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function findById(int $id);
}
