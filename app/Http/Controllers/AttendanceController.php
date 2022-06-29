<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{AttendanceSchedule,AttendanceStart,AttendanceLeave,AttendanceStatus, Employee};
use DataTables;
use Carbon\Carbon;
use Alert;

class AttendanceController extends Controller
{
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->schedule_data = AttendanceSchedule::orderBy('attendance_date','DESC')->first();
    }

    function index()
    {
        $attendance_data = AttendanceStatus::get();
        // $attendanceLeave = AttendanceLeave::get();

        // $a = $attendanceStart->merge($attendanceLeave)->first();
        // dd($a);
        // $attendance_data = 
        return view('index',compact('attendance_data'));
    }

    function storeAttendanceStart()
    {
        $time = Carbon::now()->isoFormat('HH:mm');
        $date = Carbon::now()->isoFormat('Y-m-d');
        
        $employee_data = Employee::whereHas('user', function($query){ $query->where('user_id',Auth()->user()->id_user); })->first();
        // dd($employee_data);
        // $schedule_data = AttendanceSchedule::where('attendance_date',$date)->first();
        // dd($schedule_data);
        
        $start_data = AttendanceStart::whereHas('attendanceSchedule', function($query){ $query->where('attendance_schedule_id',$this->schedule_data->id_attendance_schedule); })->first();
        // dd($this->schedule_data->id_attendance_schedule);
        if ($start_data != NULL) {
            Alert::error('Gagal','Kamu sudah absen masuk hari ini !');
            return back();
        }
        // $attendanceStart_data = new AttendanceStart();
        // $attendanceStart_data->attendance_start = $time;
        // $attendanceStart_data->attendance_schedule_id = $schedule_data->id_attendance_schedule;
        // $attendanceStart_data->save();
        $attendanceStart_data = AttendanceStart::create([
            'attendance_start' => $time,
            'attendance_schedule_id' => $this->schedule_data->id_attendance_schedule
        ]);

        $status_data = new AttendanceStatus();
        $status_data->attendance_start_id =  $attendanceStart_data->id_attendance_start; 
        $status_data->attendance_status = "absent";
        $status_data->employee_id = $employee_data->id_employee;
        $status_data->attendance_schedule_id = $this->schedule_data->id_attendance_schedule;
        $status_data->save(); 

        Alert::success('Sukses','Kamu berhasil absen masuk !');
        return redirect()->back();
    }

    function storeAttendanceLeave()
    {
        $time = Carbon::now()->isoFormat('HH:mm');
        $date = Carbon::now()->isoFormat('Y-m-d');
        
        $employee_data = Employee::whereHas('user', function($query){ $query->where('user_id',Auth()->user()->id_user); })->first();
        // $schedule_data = AttendanceSchedule::where('attendance_date',$date)->first();
        // $schedule_data = AttendanceSchedule::orderBy('attendance_date','DESC')->first();
        
        $leave_data = AttendanceLeave::whereHas('attendanceSchedule', function($query){ $query->where('attendance_schedule_id',$this->schedule_data->id_attendance_schedule); })->first();
        if ($leave_data != NULL) {
            Alert::error('Gagal','Kamu sudah absen pulang hari ini !');
            return back();
        }

        $attendanceLeave_data = AttendanceLeave::create([
            'attendance_leave' => $time,
            'attendance_schedule_id' => $this->schedule_data->id_attendance_schedule
        ]);

        $status_data = AttendanceStatus::where('employee_id',$employee_data->id_employee)->orderBy('created_at','DESC')->first();
        $status_data->attendance_leave_id =  $attendanceLeave_data->id_attendance_leave; 
        $status_data->attendance_status = "present";
        $status_data->save();

        Alert::success('Sukses','Kamu berhasil absen pulang !');
        return redirect()->back();
    }

    function viewAttendance()
    {
        return view('attendance');
    }
}
