<?php

namespace App\Interfaces;

interface AuthInterface
{
    public function login(array $data);
    public function register(array $data);
    public function checkOtpCode(array $data);
}
