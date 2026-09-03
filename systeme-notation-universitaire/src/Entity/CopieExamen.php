<?php
namespace App\Entity;
use App\Entity\AbstractDocument;
use App\Service\NoteValidator;
class CopieExamen extends AbstractDocument
{
    private float $noteBrute;
    private float $noteFinale;
    private bool $penaliteAppliquee;
    private \DateTimeImmutable $dateLimite;

    public function __construct(\DateTimeImmutable $dateDepot, float $noteBrute, bool $penaliteAppliquee, \DateTimeImmutable $dateLimite, ?int $id = null)
    {
        parent::__construct($dateDepot, $id);
        NoteValidator::validate($noteBrute);
        $this->noteBrute = $noteBrute;
        $this->penaliteAppliquee = $penaliteAppliquee;
        $this->dateLimite = $dateLimite;
    }

    public function calculerNoteFinale(float $noteFinale): void
    {
        if ($this->penaliteAppliquee) {
            $this->noteFinale = max(0, $this->noteBrute - 2);
        } else {
            $this->noteFinale = $this->noteBrute;
        }
    }


    public function getNoteBrute(): float
    {
        return $this->noteBrute;
    }
    public function setNoteBrute(float $noteBrute): void
    {
        NoteValidator::validate($noteBrute);
        $this->noteBrute = $noteBrute;
    }
    public function getNoteFinale(): float
    {
        return $this->noteFinale;
    }
    public function isPenaliteAppliquee(): bool
    {
        return $this->penaliteAppliquee;
    }
    public function setPenaliteAppliquee(bool $penaliteAppliquee): void
    {
        $this->penaliteAppliquee = $penaliteAppliquee;
    }
    public function getDateLimite(): \DateTimeImmutable
    {
        return $this->dateLimite;
    }
    public function setDateLimite(\DateTimeImmutable $dateLimite): void{
        $this->dateLimite = $dateLimite;
    }
   
}
