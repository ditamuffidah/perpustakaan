<?php

namespace App\Http\Controllers\Fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $bestSellers = [
            ['image' => asset('storage/images/senjapergi.png'), 'title' => 'Senja Pergi'],
            ['image' => asset('storage/images/sembilu.png'), 'title' => 'Sembilu'],
            ['image' => asset('storage/images/magma.png'), 'title' => 'Magma'],
            ['image' => asset('storage/images/matematika.png'), 'title' => 'Matematika'],
            ['image' => asset('storage/images/ips.png'), 'title' => 'IPS'],
        ];

        $categories = ['Umum', 'Filsafat', 'Agama', 'Sosial', 'Bahasa', 'Sains', 'Teknologi', 'Seni', 'Sastra', 'Sejarah'];

        $recommendations = [
            ['image' => asset('storage/images/informatika.png'), 'title' => 'Informatika'],
            ['image' => asset('storage/images/hts.png'), 'title' => 'HTS'],
            ['image' => asset('storage/images/harumahameru.png'), 'title' => 'Harumahameru'],
            ['image' => asset('storage/images/gadiskretek.png'), 'title' => 'Gadiskretek'],
            ['image' => asset('storage/images/fleshout.png'), 'title' => 'Fleshout'],
        ];

        $videos = [
            'https://www.youtube.com/embed/video1',
            'https://www.youtube.com/embed/video2',
            'https://www.youtube.com/embed/video3',
            'https://www.youtube.com/embed/video4',
            'https://www.youtube.com/embed/video5',
        ];

        $layout ='fe';
        return view('fe.views.dashboard', compact('bestSellers', 'categories', 'recommendations', 'videos','layout'));
    }
}
