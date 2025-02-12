<?php

return [

    'accepted' => 'A(z) :attribute mezőt el kell fogadni.',
    'accepted_if' => 'A(z) :attribute mezőt el kell fogadni, ha a(z) :other értéke :value.',
    'active_url' => 'A(z) :attribute mező nem érvényes URL.',
    'after' => 'A(z) :attribute mezőnek :date utáni dátumnak kell lennie.',
    'after_or_equal' => 'A(z) :attribute mezőnek :date utáni vagy azzal egyenlő dátumnak kell lennie.',
    'alpha' => 'A(z) :attribute mező csak betűket tartalmazhat.',
    'alpha_dash' => 'A(z) :attribute mező csak betűket, számokat, kötőjeleket és aláhúzásokat tartalmazhat.',
    'alpha_num' => 'A(z) :attribute mező csak betűket és számokat tartalmazhat.',
    'array' => 'A(z) :attribute mezőnek tömbnek kell lennie.',
    'ascii' => 'A(z) :attribute mezőnek csak egybájtos alfanumerikus karaktereket és szimbólumokat kell tartalmaznia.',
    'before' => 'A(z) :attribute mezőnek :date előtti dátumnak kell lennie.',
    'before_or_equal' => 'A(z) :attribute mezőnek :date előtti vagy azzal egyenlő dátumnak kell lennie.',
    'between' => [
        'array' => 'A(z) :attribute mezőnek :min és :max elem között kell lennie.',
        'file' => 'A(z) :attribute mező méretének :min és :max kilobájt között kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek :min és :max között kell lennie.',
        'string' => 'A(z) :attribute mezőnek :min és :max karakter között kell lennie.',
    ],
    'boolean' => 'A(z) :attribute mezőnek igaznak vagy hamisnak kell lennie.',
    'can' => 'A(z) :attribute mező nem engedélyezett értéket tartalmaz.',
    'confirmed' => 'A(z) :attribute megerősítése nem egyezik.',
    'contains' => 'A(z) :attribute mezőből hiányzik egy szükséges érték.',
    'current_password' => 'A megadott jelszó helytelen.',
    'date' => 'A(z) :attribute mező nem érvényes dátum.',
    'date_equals' => 'A(z) :attribute mezőnek :date dátummal egyenlőnek kell lennie.',
    'date_format' => 'A(z) :attribute mező nem felel meg a következő formátumnak: :format.',
    'decimal' => 'A(z) :attribute mezőnek :decimal tizedesjegyből kell állnia.',
    'declined' => 'A(z) :attribute mezőt el kell utasítani.',
    'declined_if' => 'A(z) :attribute mezőt el kell utasítani, ha a(z) :other értéke :value.',
    'different' => 'A(z) :attribute és :other mezőknek különbözőnek kell lenniük.',
    'digits' => 'A(z) :attribute mezőnek :digits számjegyből kell állnia.',
    'digits_between' => 'A(z) :attribute mezőnek :min és :max számjegy között kell lennie.',
    'dimensions' => 'A(z) :attribute mező érvénytelen képméretekkel rendelkezik.',
    'distinct' => 'A(z) :attribute mezőben ismétlődő érték található.',
    'doesnt_end_with' => 'A(z) :attribute mező nem végződhet az alábbiakkal: :values.',
    'doesnt_start_with' => 'A(z) :attribute mező nem kezdődhet az alábbiakkal: :values.',
    'email' => 'A(z) :attribute mezőnek érvényes e-mail címnek kell lennie.',
    'ends_with' => 'A(z) :attribute mezőnek az alábbiak egyikével kell végződnie: :values.',
    'enum' => 'A kiválasztott :attribute érvénytelen.',
    'exists' => 'A kiválasztott :attribute érvénytelen.',
    'extensions' => 'A(z) :attribute mezőnek az alábbi kiterjesztések egyikével kell rendelkeznie: :values.',
    'file' => 'A(z) :attribute mezőnek fájlnak kell lennie.',
    'filled' => 'A(z) :attribute mezőt ki kell tölteni.',
    'gt' => [
        'array' => 'A(z) :attribute mezőnek több mint :value elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mező méretének nagyobbnak kell lennie, mint :value kilobájt.',
        'numeric' => 'A(z) :attribute mezőnek nagyobbnak kell lennie, mint :value.',
        'string' => 'A(z) :attribute mezőnek hosszabbnak kell lennie, mint :value karakter.',
    ],
    'gte' => [
        'array' => 'A(z) :attribute mezőnek legalább :value elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute mező méretének legalább :value kilobájtnak kell lennie.',
        'numeric' => 'A(z) :attribute mezőnek legalább :value értékűnek kell lennie.',
        'string' => 'A(z) :attribute mezőnek legalább :value karakterből kell állnia.',
    ],
    'image' => 'A(z) :attribute mezőnek képnek kell lennie.',
    'in' => 'A kiválasztott :attribute érvénytelen.',
    'integer' => 'A(z) :attribute mezőnek egész számnak kell lennie.',

    'valasztott-szak' => [
        'egyetem' => [
            'required' => 'Az egyetem megadása kötelező.',
        ],
    ],
    'erettsegi-eredmenyek' => [
        '*.eredmeny' => [
            'regex' => 'Az eredménynek százalékos formátumban kell lennie (pl. 70%).',
        ],
    ],
    'tobbletpontok' => [
        '*.kategoria' => [
            'in' => 'Csak a "Nyelvvizsga" kategória engedélyezett.',
        ],
        '*.tipus' => [
            'in' => 'A nyelvvizsga típusa csak az alábbi lehet: :languages.',
        ],
    ],

];
