<?php

namespace App\Interface;
// interface
interface SockableInterface
{
    public function addStocks(int $stock): self;
    public function removeStocks(int $stock): self;
}