<?php
namespace App\Repository;
use App\Entity\CopieExamen;
interface CopieExamenRepositoryInterface
{
    public function save(CopieExamen $copieExamen):int;
    public function findById(int $id):?CopieExamen;
    public function findAll():array;
}