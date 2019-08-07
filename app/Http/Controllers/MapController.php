<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barbershop;
use Map;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barbershops = Barbershop::where('status', 'Terverifikasi')->get();

        $config = array();
        $config['map_height'] = '550px';
        $config['zoom'] = 'auto';
        $config['draggableCursor'] = 'default';
        Map::initialize($config);
        
        $config['cluster'] = FALSE;
        $config['clusterStyles'] = array(
            array(
            "url"=>"https://raw.githubusercontent.com/googlemaps/js-marker-clusterer/gh-pages/images/m1.png",
            "width"=>"53",
            "height"=>"53"
            ));
        Map::initialize($config);
        foreach($barbershops as $barbershop){
            $marker = array();
            $marker['position'] = $barbershop->longitude.', '.$barbershop->latitude;
            $marker['infowindow_content'] = '<div style="text-align: center"><strong>'.$barbershop->name.'</strong><hr><img src="/img/barbershop/'.$barbershop->gambar.'"style="height: 100px"><br><br><a target="_blank" href="/barbershop/'.$barbershop->id.'">Lihat Barbershop</a><br><a target="_blank" href="https://www.google.com/maps/dir//'.$barbershop->longitude.','.$barbershop->latitude.'">Petunjuk Arah</a></div>';
            Map::add_marker($marker);
        }

        Map::initialize($config);
        $map = Map::create_map();
        return view('peta', compact('map', 'barbershops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
}
