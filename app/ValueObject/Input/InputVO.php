<?php

declare(strict_types=1);

namespace App\ValueObject\Input;

use App\Exceptions\InvalidDataException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class InputVO
{
    public function __construct(
        private SelectedMajorVO $selectedMajor,
        private ResultVO        $result,
        private ?ExtraPointVO   $extraPoint,      //A tesztek során van olyan opció, ahol az extra pontokat nem nézzük
    )
    {
    }

    /**
     * @throws InvalidDataException
     */
    public static function create(array $data): self
    {
        try {
            $selectedMajor = $data['valasztott-szak'];
            $result = $data['erettsegi-eredmenyek'];
            $extraPoint = $data['tobbletpontok'] ?? null;

            $InputVO = new self(
                SelectedMajorVO::create($selectedMajor),
                ResultVO::create($result),
                $extraPoint ? ExtraPointVO::create($extraPoint) : null
            );

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            throw new InvalidDataException(__('exception.invalid_inputs'));
        }

        return $InputVO;
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
