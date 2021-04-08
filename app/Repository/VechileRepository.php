<?php


namespace App\Repository;

use App\Interfaces\VechileRepositoryInterface;
use App\Models\Customer;
use App\Models\Vechile;

class VechileRepository implements VechileRepositoryInterface
{
    public function addVechile($data)
    {
        return Vechile::create($data);
    }

    public function allVechiles()
    {
        return Vechile::paginate(10);
    }
    public function deleteVechile($vechile_id)
    {
    }

    public function findByID($vechile_id)
    {
        return Vechile::where('uuid', $vechile_id)->first();
    }

    public function restoreVechile($vechile_id)
    {
    }

    public function updateVechile($vechile_id, $data)
    {
    }
}
