<?php

namespace App\Http\Controllers;

use App\Models\Fossil;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function welcome(){

        $cantTodayUploadsFossils = Fossil::getCount(null, 'today');
        $cantTotalFossils = Fossil::getCount(null);
        $cantMembers = User::getCantMembers();

        return Inertia::render('Welcome/Welcome', compact(
            'cantTodayUploadsFossils',
            'cantTotalFossils',
            'cantMembers'
        ));
    }

}
