<?php
namespace App\DTO;
    readonly class SoumettreCopieDTO
    {
        private function __construct(
            public float $noteBrute,
            public \DateTimeImmutable $dateDepot,
            public \DateTimeImmutable $dateLimite
        ) {
            
        }


            
    }