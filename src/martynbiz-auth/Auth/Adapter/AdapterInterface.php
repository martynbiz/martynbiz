<?php
namespace MartynBiz\Auth\Adapter;

interface AdapterInterface
{
    /**
     * Performs an authentication attempt
     */
    public function authenticate($identity, $password);
}
