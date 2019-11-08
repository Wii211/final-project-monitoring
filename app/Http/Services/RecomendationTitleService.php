<?php

namespace App\Http\Services;

use App\RecomendationTitle;
use Illuminate\Http\Request;

class RecomendationTitleService
{
    private $recomendationTitle;

    public function __construct(RecomendationTitle $recomendationTitle)
    {
        $this->recomendationTitle = $recomendationTitle;
    }

    public function getListData($search)
    {
        return $this->recomendationTitle->with(['lecturer', 'topics'])
            ->search($search)->get();
    }

    public function getData($id)
    {
        return $this->recomendationTitle->with(['lecturer', 'topics'])->findOrFail($id);
    }

    public function storeData(Request $request)
    {
        try {
            $this->recomendationTitle->create(
                array_merge(
                    $request->except([
                        'topics'
                    ])
                )
            )->topics()->attach($request->topics);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateData(Request $request, $id)
    {
        try {
            $recomendationTitle = $this->recomendationTitle->findOrFail($id);

            $recomendationTitle->update(
                array_merge(
                    $request->except([
                        'topics'
                    ])
                )
            );
            $recomendationTitle->topics()->sync($request->topics);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function deleteData($id)
    {
        if ($this->recomendationTitle->destroy($id)) {
            return true;
        } else {
            return false;
        }
    }
}
