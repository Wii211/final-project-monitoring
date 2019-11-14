<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\DeadlineSchedule;
use App\FinalStatus;
use Illuminate\Http\Request;

class DeadLineScheduleService
{
    private $deadlineSchedule, $finalStatus;

    public function __construct(DeadlineSchedule $deadlineSchedule, FinalStatus $finalStatus)
    {
        $this->deadlineSchedule = $deadlineSchedule;
        $this->finalStatus = $finalStatus;
    }
    public function showProposalRegisterDeadLine()
    {
        $deadlineSchedule = $this->deadlineSchedule
            ->whereFinalStatusId($this->finalStatus->name('pendaftaran'))->first();

        $endDate = Carbon::parse($deadlineSchedule->end_date);

        $differenceBetweenDate = $endDate->diffInDays(Carbon::now());

        return compact('endDate', 'differenceBetweenDate');
    }

    public function getListData()
    {
        return $this->deadlineSchedule->get();
    }

    public function updateSchedules(Request $request)
    {
        $finalStatuses = [
            'registration' => [
                'id' => $this->finalStatus->name('pendaftaran'),
                'start_date' => date($request->registration_start_date),
                'end_date' => date($request->registration_end_date)
            ],

            'pre_proposal' => [
                'id' => $this->finalStatus->name('pra-proposal'),
                'start_date' => date($request->registration_end_date),
                'end_date' => date($request->pre_proposal_end_date)
            ],
            'proposal' => [
                'id' => $this->finalStatus->name('proposal'),
                'start_date' => date($request->pre_proposal_end_date),
                'end_date' => date($request->proposal_end_date)
            ],
            'proposal_revision' => [
                'id' => $this->finalStatus->name('revisi_proposal'),
                'start_date' => date($request->proposal_end_date),
                'end_date' => date($request->revision_proposal_end_date)
            ],
            'final' => [
                'id' => $this->finalStatus->name('tugas_akhir'),
                'start_date' => date($request->revision_proposal_end_date),
                'end_date' => date($request->final_project_end_date)
            ],
            'final_revision' => [
                'id' => $this->finalStatus->name('revisi_tugas_akhir'),
                'start_date' => date($request->final_project_end_date),
                'end_date' => date($request->revision_final_project_end_date)
            ],
            'end_of_final' => [
                'id' => $this->finalStatus->name('tugas_akhir_selesai'),
                'start_date' => date($request->revision_final_project_end_date),
                'end_date' => date($request->revision_final_project_end_date)
            ],
        ];

        try {
            foreach ($finalStatuses as $finalStatus) {

                $deadlineSchedule = $this->deadlineSchedule->whereFinalStatusId($finalStatus['id'])->first();

                $deadlineSchedule->start_date = $finalStatus['start_date'];
                $deadlineSchedule->end_date = $finalStatus['end_date'];

                $deadlineSchedule->save();
            }
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }
}
