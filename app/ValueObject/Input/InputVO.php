<?php

declare(strict_types=1);

namespace App\ValueObject\Input;

final readonly class InputVO
{
    public function __construct(
        private SelectedMajorVO $selectedMajor,
        private ResultVO        $result,
        private ?ExtraPointVO   $extraPoint,      //A tesztek során van olyan opció, ahol az extra pontokat nem nézzük
    )
    {
    }

    public static function create(array $data): self
    {
        $selectedMajor = $data['valasztott-szak'];
        $result = $data['erettsegi-eredmenyek'];
        $extraPoint = $data['tobbletpontok'] ?? null;

        return new self(
            SelectedMajorVO::create($selectedMajor),
            ResultVO::create($result),
            $extraPoint ? ExtraPointVO::create($extraPoint) : null
        );
    }

    public function getSelectedMajor(): SelectedMajorVO
    {
        return $this->selectedMajor;
    }

    public function getResult(): ResultVO
    {
        return $this->result;
    }

    public function getExtraPoint(): ?ExtraPointVO
    {
        return $this->extraPoint;
    }
}
