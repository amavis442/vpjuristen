<?php
/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 5/28/17
 * Time: 7:43 PM
 */

namespace App\Domain\Contract;


interface UserInterface
{
    public function isActive();
    public function hasRole($name);
}