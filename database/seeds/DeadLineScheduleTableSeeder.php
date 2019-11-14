<?php

use App\FinalStatus;
use Illuminate\Database\Seeder;

class DeadLineScheduleTableSeeder extends Seeder
{

    private $finalStatus;

    public function __construct(FinalStatus $finalStatus)
    {
        $this->finalStatus = $finalStatus;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $finalStatus = $this->finalStatus;

        if (DB::table('deadline_schedules')->get()->count() == 0) {
            DB::table('deadline_schedules')->insert([
                [
                    'start_date' => date('2012-01-01 00:00:00'),
                    'end_date' => date('2014-01-01 00:00:00'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'final_status_id' => $finalStatus->whereName('pendaftaran')->first()->id,
                ],
                [
                    'start_date' => date('2012-01-01 00:00:00'),
                    'end_date' => date('2014-01-01 00:00:00'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'final_status_id' => $finalStatus->whereName('pra-proposal')->first()->id,
                ],
                [
                    'start_date' => date('2012-01-01 00:00:00'),
                    'end_date' => date('2014-01-01 00:00:00'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'final_status_id' => $finalStatus->whereName('proposal')->first()->id,
                ],
                [
                    'start_date' => date('2012-01-01 00:00:00'),
                    'end_date' => date('2014-01-01 00:00:00'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'final_status_id' => $finalStatus->whereName('revisi_proposal')->first()->id,
                ],
                [
                    'start_date' => date('2012-01-01 00:00:00'),
                    'end_date' => date('2014-01-01 00:00:00'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'final_status_id' => $finalStatus->whereName('tugas_akhir')->first()->id,
                ],
                [
                    'start_date' => date('2012-01-01 00:00:00'),
                    'end_date' => date('2014-01-01 00:00:00'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'final_status_id' => $finalStatus->whereName('revisi_tugas_akhir')->first()->id,
                ],
                [
                    'start_date' => date('2012-01-01 00:00:00'),
                    'end_date' => date('2014-01-01 00:00:00'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'final_status_id' => $finalStatus->whereName('tugas_akhir_selesai')->first()->id,
                ],
            ]);
        }
    }
}
