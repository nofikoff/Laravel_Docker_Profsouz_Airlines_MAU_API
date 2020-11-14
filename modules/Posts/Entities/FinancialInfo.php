<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Mpdf\Mpdf;

class FinancialInfo extends Model
{

    protected $fillable = [
        'pdf_rr',
        'pdf_mfo',
        'pdf_card',
        'pdf_bank',
        'pdf_edrpoy',
        'pdf_extradited',
        'pdf_passport_code',
        'pdf_passport_seria',
        'pdf_identification',
    ];

    protected $appends = [
        'pdf_fio',
        'pdf_phone',
        'title'
    ];

    /**
     * @return mixed|string
     */
    public function getTitleAttribute()
    {
        return $this->post->title;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return string
     */
    public function getPdfFioAttribute()
    {
        return $this->post->user->full_name;
    }

    /**
     * @return string
     */
    public function getPdfPhoneAttribute()
    {
        return $this->post->user->phone;
    }

    /**
     * @return null|string
     */
    public function getPdfContent()
    {
        try {
            $mpdf = new Mpdf(['tempDir' => storage_path('app/tmp')]);
            $mpdf->WriteHTML(view('posts::document', $this->toArray())->render());

            return $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);
        } catch (\Exception $e) {
            return null;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
