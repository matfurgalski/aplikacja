<?php

namespace App\Enums;

class UserRole
{
    const USER = 'uzytkownik';
    const WLASCICIEL = 'wlasciciel';
    const WYNAJMUJACY = 'wynajmujacy';

    const TYPES = [
        self::USER,
        self::WLASCICIEL,
        self::WYNAJMUJACY
    ];
}