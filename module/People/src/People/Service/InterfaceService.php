<?php
namespace People\Service;

interface InterfaceService
{
    public function store(array $data, $flush = true);

    public function update($id, array $data, $flush = true);
}