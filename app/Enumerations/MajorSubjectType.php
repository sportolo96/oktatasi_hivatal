<?php

namespace App\Enumerations;

enum MajorSubjectType: string
{
    case REQUIRED = 'kotelezo';
    case OPTIONAL_REQUIRED = 'kotelezoen_valaszthato';
}
