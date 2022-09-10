<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StarterKitController extends Controller
{
    //index
    public function index(){
      return view('pages.dashboard-ecommerce');
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
