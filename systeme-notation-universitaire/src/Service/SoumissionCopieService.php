<?php

namespace App\Service;
use App\Entity\CopieExamen;
use App\Repository\CopieExamenRepositoryInterface;
use App\Service\CalculNoteInterface;
use App\DTO\SoumettreCopieDTO;
final class SoumissionCopieService
{
    //private readonly CopieExamenRepositoryInterface $copieExamenRepository;
    public function __construct(
    
        private readonly CopieExamenRepositoryInterface $copieExamenRepository
    ) {
        //$this->copieExamenRepository = PdoCopieExamenRepository::getInstance(new \PDO('sqlite:' . __DIR__ . '/../../data/copie_examen.db'));
    }

    public function soumettre(
        CalculNoteInterface $calculNote,
        SoumettreCopieDTO $dto
    ): CopieExamen {
        $enRetard = $calculNote->estEnRetard($dto->dateDepot, $dto->dateLimite);
        $noteFinale = $calculNote->calculerNoteFinale($dto->noteBrute, $enRetard);

        $copieExamen = new CopieExamen(
            $dto->dateDepot,
            $dto->noteBrute,
            $enRetard,
            $dto->dateLimite
        );
        $copieExamen->setNoteFinale($noteFinale);

        return $this->copieExamenRepository->save($copieExamen);
    }
}