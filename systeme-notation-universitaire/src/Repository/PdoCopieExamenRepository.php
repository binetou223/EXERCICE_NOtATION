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

    public function save(CopieExamen $copieExamen): int
    {
        $sql = "INSERT INTO notation (date_depot, note_brute, penalite_appliquee, date_limite,note_finale)
       VALUES (:dateDepot, :noteBrute, :penaliteAppliquee, :dateLimite, :noteFinale)";
        $this->executeUpdate($sql, [
            ':dateDepot' => $copieExamen->getDateDepot(),
            ':noteBrute' => $copieExamen->getNoteBrute(),
            ':penaliteAppliquee' => $copieExamen->isPenaliteAppliquee() ? 1 : 0,
            ':dateLimite' => $copieExamen->getDateLimite(),
            ':noteFinale' => $copieExamen->getNoteFinale()
        ]);
        return (int)$this->db->lastInsertId();
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