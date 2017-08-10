<?php


namespace App\Contracts;


interface WrestlerRepository
{
    public function all();
    public function find($id);
}