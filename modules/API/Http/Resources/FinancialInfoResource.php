<?php

namespace Modules\API\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class FinancialInfoResource extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'pdf_rr'             => $this->pdf_rr,
            'pdf_mfo'            => $this->pdf_mfo,
            'pdf_fio'            => $this->pdf_fio,
            'pdf_card'           => $this->pdf_card,
            'pdf_bank'           => $this->pdf_bank,
            'pdf_phone'          => $this->pdf_phone,
            'pdf_edrpoy'         => $this->pdf_edrpoy,
            'pdf_extradited'     => $this->pdf_extradited,
            'pdf_passport_code'  => $this->pdf_passport_code,
            'pdf_passport_seria' => $this->pdf_passport_seria,
            'pdf_identification' => $this->pdf_identification,
        ];
    }
}
