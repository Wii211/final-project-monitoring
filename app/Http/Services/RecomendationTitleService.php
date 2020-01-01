<?php

namespace App\Http\Services;

use App\User;
use App\RecomendationTitle;
use Illuminate\Http\Request;

class RecomendationTitleService
{
    private $recomendationTitle, $user;

    public function __construct(RecomendationTitle $recomendationTitle, User $user)
    {
        $this->recomendationTitle = $recomendationTitle;
        $this->user = $user;
    }

    public function getListData($search)
    {
        return $this->recomendationTitle->with(['lecturer', 'topics', 'finalStudent'])
            ->search($search)->paginate(5);
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
                    ]),
                    ['user_id' => $this->user->getAuthId()]
                )
            )->topics()->attach($request->topics);
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public function updateData(Request $request, $id)
    {
        try {
            $recomendationTitle = $this->recomendationTitle->findOrFail($id);

            $recomendationTitle->update(
                array_merge(
                    $request->except([
                        'topics'
                    ]),
                    ['user_id' => $this->user->getAuthId()]
                )
            );
            $recomendationTitle->topics()->sync($request->topics);
        } catch (\Throwable $th) {
            return false;
        }
        return true;
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
