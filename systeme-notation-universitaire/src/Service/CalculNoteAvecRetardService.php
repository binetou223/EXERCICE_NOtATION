<?php
namespace App\Service;
use App\Service\CalculNoteInterface;

class CalculNoteAvecRetardService implements CalculNoteInterface
{
    public function calculerNote(float $noteBrute, bool $penaliteAppliquee): float
    {
          if (!$penaliteAppliquee) {
            return $noteBrute;
        }

        return max(0, $noteBrute - 2);

    }
}