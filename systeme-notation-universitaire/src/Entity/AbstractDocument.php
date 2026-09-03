<?php
namespace App\Entity;
abstract class AbstractDocument {
    protected ?int $id = null;
    protected \DateTimeImmutable $dateDepot;

    protected function __construct(\DateTimeImmutable $dateDepot, ?int $id = null){
        $this->id = $id;
        $this->dateDepot = $dateDepot;
    }

    public function getId(): ?int{
        return $this->id;
    }
    public function setId(int $id): void{
        $this->id = $id;
    }

    public function getDateDepot(): \DateTimeImmutable{
        return $this->dateDepot;
    }
}
