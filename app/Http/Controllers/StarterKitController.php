<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StarterKitController extends Controller
{
    //index
    public function index(){
      //list tahun
      $listTahun = DB::table('pendaftaran')
                ->select(DB::raw('YEAR(pentglrujukan) as year'))
                ->groupBy('year')
                ->orderBy('year', 'DESC')
                ->get();

      //last recent transaction 

      $dataTransaction = DB::table('pendaftaran')
            ->select('pendaftaran.*','pasien.*','pengirim.*','jenispembayaran.*','users.name')
            ->join('pasien','pasien.pasid','=','pendaftaran.penpasid')
            ->join('pengirim','pengirim.pengid','=','pendaftaran.penpengid')
            ->join('jenispembayaran','jenispembayaran.pemid','=','pendaftaran.penpemid')
            ->join('users','users.id','=','pendaftaran.created_by')
            ->orderBy('penid', 'desc')
            ->latest('pendaftaran.pentgl')
            ->take(4)
            ->get();
      
      return view('pages.dashboard-ecommerce', ['listTahun' => $listTahun, 'dataTransaction' => $dataTransaction]);
    }
    public function column_1Sk(){
       // Breadcrumbs
     $breadcrumbs = [
      ['link' => "/", 'name' => "Home"], ['link' => "#", 'name' => "Starter Kit"], ['name' => "1 Column"],
      ];
      //Pageheader set true for breadcrumbs
      $pageConfigs = ['pageHeader' => true];

      return view('pages.sk-layout-1-column',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);
    }
    public function columns_2Sk(){
      // Breadcrumbs
     $breadcrumbs = [
      ['link' => "/", 'name' => "Home"], ['link' => "#", 'name' => "Starter Kit"], ['name' => "2 Columns"],
      ];
      //Pageheader set true for breadcrumbs
      $pageConfigs = ['pageHeader' => true];

      return view('pages.sk-layout-2-columns',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);
    }

    public function fix_navbar(){
      // Breadcrumbs
      $breadcrumbs = [
        ['link' => "/", 'name' => "Home"], ['link' => "#", 'name' => "Starter Kit"], ['name' => "Fixed Navbar"],
      ];
      //Pageheader set true for breadcrumbs
      $pageConfigs = ['pageHeader' => true];

      return view('pages.sk-layout-fixed-navbar',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);
    }
    public function fix_layout(){
      // Breadcrumbs
      $breadcrumbs = [
        ['link' => "/", 'name' => "Home"], ['link' => "#", 'name' => "Starter Kit"], ['name' => "Fixed Layout"],
      ];
      //Pageheader set true for breadcrumbs
      $pageConfigs = ['pageHeader' => true,'footerType' => 'fixed'];

      return view('pages.sk-layout-fixed',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);
    }
    public function static_layout(){
       // Breadcrumbs
       $breadcrumbs = [
        ['link' => "/", 'name' => "Home"], ['link' => "#", 'name' => "Starter Kit"], ['name' => "Static Layout"],
      ];
      //Pageheader set true for breadcrumbs
      $pageConfigs = ['pageHeader' => true,'navbarType' => 'static'];

      return view('pages.sk-layout-fixed',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);
    }
}
