<?php

namespace App\Interfaces;

interface VechileRepositoryInterface
{
    public function addVechile($data);
    public function deleteVechile($vechile_id);
    public function findByID($vechile_id);
    public function restoreVechile($vechile_id);
    public function updateVechile($vechile_id, $data);
    public function allVechiles();
}
