<?php

namespace App\core;

abstract class UserModel extends ORM
{
    abstract public function getDisplayName(): string;
}