<?php

use App\Enumerations\MajorSubjectType;
use App\Enumerations\SubjectLevel;

return [
    'ELTE' => [
        'IK' => [
            'Programtervező informatikus' => [
                MajorSubjectType::REQUIRED->value => [
                    'matematika' => SubjectLevel::INTERMEDIATE
                ],
                MajorSubjectType::OPTIONAL_REQUIRED->value => [
                    'informatika' => SubjectLevel::INTERMEDIATE,
                    'biológia' => SubjectLevel::INTERMEDIATE,
                    'fizika' => SubjectLevel::INTERMEDIATE,
                    'kémia' => SubjectLevel::INTERMEDIATE
                ],
            ],
        ],
    ],
    'PPKE' => [
        'BTK' => [
            'Anglisztika' => [
                MajorSubjectType::REQUIRED->value => [
                    'angol' => SubjectLevel::ADVANCED
                ],
                MajorSubjectType::OPTIONAL_REQUIRED->value => [
                    'francia' => SubjectLevel::INTERMEDIATE,
                    'német' => SubjectLevel::INTERMEDIATE,
                    'olasz' => SubjectLevel::INTERMEDIATE,
                    'orosz' => SubjectLevel::INTERMEDIATE,
                    'spanyol' => SubjectLevel::INTERMEDIATE,
                    'történelem' => SubjectLevel::INTERMEDIATE
                ],
            ],
        ],
    ],
];
