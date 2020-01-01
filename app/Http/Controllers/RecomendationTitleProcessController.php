<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Services\RecomendationTitleTempService;

class RecomendationTitleProcessController extends Controller
{
    private $titleTempService;

    public function __construct(RecomendationTitleTempService $titleTempService)
    {
        $this->titleTempService = $titleTempService;
    }


    public function update($recomendationTitleId)
    {
        return response()->json($this->titleTempService
            ->acceptTitleRequest($recomendationTitleId));
    }

    public function destroy($recomendationTitleId)
    {
        return response()->json($this->titleTempService
            ->declineTitleRequest($recomendationTitleId));
    }
}
