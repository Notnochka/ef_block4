<?php
namespace di;

interface UserRepositoryInterface {
    public function findAll(): array;
}
