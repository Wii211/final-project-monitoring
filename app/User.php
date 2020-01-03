<?php

namespace App;

use App\Role;
use App\Admin;
use App\FinalLog;
use Carbon\Carbon;
use App\FinalStatus;
use App\FinalStudent;
use App\FinalSchedule;
use App\FinalRequirement;
use App\RecomendationTitle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password', 'phone_number', 'gender', 'image_profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function finalStudent()
    {
        return $this->hasOne(FinalStudent::class);
    }

    public function recomendationTitles()
    {
        return $this->hasMany(RecomendationTitle::class);
    }

    public function hasRoles($roleName)
    {
        foreach ($this->roles as $role) {
            if ($role->name === $roleName) return true;
        }
        return false;
    }

    public function isStudent()
    {
        foreach ($this->roles as $role) {
            if ($role->name === "mahasiswa") return true;
        }
        return false;
    }

    public function isAdmin()
    {
        foreach ($this->roles as $role) {
            if ($role->name === 'admin') return true;
        }
        return false;
    }

    public function isCoordinator()
    {
        foreach ($this->roles as $role) {
            if ($role->name === 'koordinator') return true;
        }
        return false;
    }

    public function redirectTo()
    {
        if ($this->isCoordinator()) {
            return 'coordinator_dashboard.index';
        } elseif ($this->isAdmin()) {
            return 'final_projects.index';
        } elseif ($this->isStudent()) {
            return 'final_registration.index';
        }
    }

    public static function getAuthId()
    {
        return Auth::user()->id;
    }

    public static function getName()
    {
        return Auth::user()->user_name;
    }

    public function isVerified()
    {
        return Auth::user()->finalStudent->is_verified;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function isPastDeadlineFinalProject()
    {
        $finalProjectId = $this->finalProject
            ->whereFinalStudentId($this->finalStudent->getStudentId())->first();

        if ($finalProjectId) {
            $finalProjectId = $finalProjectId->id;

            $finalLog = FinalLog::whereFinalProjectId($finalProjectId)
                ->whereFinalStatusId(FinalStatus::name('tugas_akhir'))->first();

            $deadlineSchedule = DeadlineSchedule::whereFinalStatusId($finalLog->final_status_id)->first();

            $endDate = Carbon::parse($deadlineSchedule->end_date);

            if ($endDate->isPast()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function isPastDeadLineSchedule()
    {
        $deadlineSchedule = new DeadlineSchedule;

        return $deadlineSchedule->checkPastDeadLineSchedule() ? true : false;
    }

    public function finalRequirementAlreadySubmitted($finalLogId)
    {
        $finalRequirement = new FinalRequirement;

        return $finalRequirement->alreadySubmitted($finalLogId) ? true : false;
    }

    public function finalScheduleStatus($finalLogId)
    {
        $finalSchedule = new FinalSchedule;

        return $finalSchedule->scheduleStatus($finalLogId);
    }

    public function recomendationTitleIsPicked()
    {
        $recomendationTitle = new RecomendationTitle;

        return $recomendationTitle->isPicked();
    }
}
