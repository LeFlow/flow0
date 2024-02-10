<?php

declare(strict_types=1);

namespace App\Utils;

final class StringUtils
{
    public static function startsWithIgnoreCase(string $subject, string $search): bool
    {
        $subjectLen = mb_strlen($subject);
        $searchLen = mb_strlen($search);

        if ($searchLen > $subjectLen) {
            return false;
        }

        return strtolower(mb_substr($subject, 0, $searchLen)) === strtolower($search);
    }

    // Ajoutez d'autres fonctions utiles ici
}