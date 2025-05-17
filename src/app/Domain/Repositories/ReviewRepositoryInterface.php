<?php

namespace App\Domain\Repositories;

interface ReviewRepositoryInterface
{
    public function all();
    public function findById();
    public function save();
    public function update();
    public function delete();
}
