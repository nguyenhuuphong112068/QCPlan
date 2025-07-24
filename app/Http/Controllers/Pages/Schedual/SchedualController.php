<?php

namespace App\Http\Controllers\Pages\Schedual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SchedualController extends Controller
{
    public function index()
    {
        session()->put(['title' => 'Lịch Kiểm Nghiệm']);

        // Dữ liệu mẫu
        $datas = [
            'resources' => [
                ['id' => 1, 'text' => 'Thiết bị A'],
                ['id' => 2, 'text' => 'Thiết bị B']
            ],
                    'tasks' => [
                        [
                        'id' => 1,
                        'text' => 'Mẫu A1',
                        'start_date' => '2025-07-24 08:00',
                        'duration' => 2,
                        'device_id' => 1
                        ],
                        [
                        'id' => 2,
                        'text' => 'Mẫu A2',
                        'start_date' => '2025-07-24 10:30',
                        'duration' => 2,
                        'device_id' => 1
                        ],
                        [
                        'id' => 3,
                        'text' => 'Mẫu B1',
                        'start_date' => '2025-07-24 09:00',
                        'duration' => 1,
                        'device_id' => 2
                        ]
                    ]
                    ];

        return Inertia::render('GanttChart', [
            'datas' => $datas,
            'title' => session('title'),
            'user' => session('user'),
        ]);
    }
}
