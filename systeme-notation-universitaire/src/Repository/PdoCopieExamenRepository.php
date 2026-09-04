<?php

namespace App\Entity;

use App\Repository\CopieExamenRepositoryInterface;
use App\Repository\AbstractRepository;

class PdoCopieExamenRepository extends AbstractRepository implements CopieExamenRepositoryInterface
{
    public function __construct(\PDO $db)
    {
        parent::__construct($db);
    }
    public function save(CopieExamen $copieExamen): CopieExamen
    {
         $sql = "INSERT INTO notation (date_depot, note_brute, penalite_appliquee, date_limite,note_finale)
       VALUES (:dateDepot, :noteBrute, :penaliteAppliquee, :dateLimite, :noteFinale)";
        $id = $this->executeUpdate($sql, [
            'dateDepot' => $copieExamen->getDateDepot()->format('Y-m-d H:i:s'),
            'noteBrute' => $copieExamen->getNoteBrute(),
            'noteFinale' => $copieExamen->getNoteFinale(),
            'penaliteAppliquee' => $copieExamen->isPenaliteAppliquee() ? 1 : 0,
            'dateLimite' => $copieExamen->getDateLimite()->format('Y-m-d H:i:s'),
        ]);

        $copieExamen->setId((int) $id);

        return $copieExamen;
    }

    public function findById(int $id): ?CopieExamen
    {
        $sql = "SELECT * FROM notation WHERE id = :id";
        $result = $this->executeQuery($sql, ['id' => $id]);
        if (!$result) {
            return null;
        }
        return new CopieExamen(
            $result['date_creation'],
            $result['note_brute'],
            $result['note_finale'],
            $result['penalite_appliquee'],
            $result['date_limite']
        );
    }
    public function findAll(): array
    {
        $sql = "SELECT * FROM notation";
        $results = $this->executeQuery($sql , [], false);
        array_map(function ($result) {
            return new CopieExamen(
                $result['date_creation'],
                $result['note_brute'],
                $result['note_finale'],
                $result['penalite_appliquee'],
                $result['date_limite']
            );
        }, $results);
        return $results;
    }
}