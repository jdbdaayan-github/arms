<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Record;
use App\Models\AuditLog;
use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    protected $record_model;
    protected $user_model;
    protected $activity_model;

    public function __construct()
    {
        $this->record_model = new Record();
        $this->user_model = new User();
        $this->activity_model = new AuditLog();
    }

    public function superadminDashboard()
    {
        $data['totalRecords'] = $this->record_model->countAllResults();
        $data['totalUsers'] = $this->user_model->countAllResults();
        $data['recentRecords'] = $this->record_model->getRecentRecords();
        $data['latestUsers'] = $this->user_model->getLatestUsers();
        $activities = $this->activity_model->getRecentActivity();

          // Sample chart data (records per month)
        $builder = $this->record_model->select("MONTH(created_at) as month, COUNT(*) as total")
            ->groupBy('MONTH(created_at)')
            ->orderBy('MONTH(created_at)', 'ASC')
            ->findAll();

        $labels = [];
        $values = [];
        foreach ($builder as $row) {
            $labels[] = date("M", mktime(0,0,0,$row->month,1));
            $values[] = $row->total;
        }

        $data['chartLabels'] = $labels;
        $data['chartData']   = $values;

        foreach($activities as $activity)
        {
            $activity->time_ago = Time::parse($activity->timestamp)->humanize();
        }

        $data['recentActivities'] = $activities;
        

        return view('dashboards/superadmin/dashboard', $data);
    }

    public function adminDashboard()
    {
        return view('dashboards/administrator/dashboard');
    }

    public function archivistDashboard()
    {
        return view('dashboards/archivist/dashboard');
    }

    public function recordsOfficerDashboard()
    {
        return view('dashboards/records_officer/dashboard');
    }

    public function contributorDashboard()
    {
        return view('dashboards/contributor/dashboard');
    }
}
