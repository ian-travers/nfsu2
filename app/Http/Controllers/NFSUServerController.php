<?php

namespace App\Http\Controllers;

use App\Models\NFSUServer\RealServer;

class NFSUServerController extends Controller
{
    public function monitor()
    {
        return view('frontend.server.monitor', [
            'serverInfo' => new RealServer(config('nfsu-server.ip'), config('nfsu-server.port')),
            'title' => __('Server monitor')
        ]);
    }
}
