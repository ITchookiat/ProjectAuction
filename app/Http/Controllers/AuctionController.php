<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\datacar;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      if ($request->get('searchDatacar') != Null) {

        $idSearch = $request->get('searchDatacar');
        $data = datacar::where('IDCard_car',$idSearch)
                      ->orderBy('datacars.IDCard_car', 'ASC')->limit(1)
                      ->get();
        $Countdata = count($data);
      }else {
        $data = DB::table('datacars')
        ->orderBy('datacars.IDCard_car', 'ASC')->limit(1)
        ->get();

        $Countdata = count($data);
      }
      return view('Auction.Home',compact('data','Countdata'));
    }

    public function Searchindex(Request $request,$id)
    {

      $data = datacar::where('id',$id)
                    ->orderBy('datacars.IDCard_car', 'ASC')->limit(1)
                    ->get();
      $Countdata = count($data);
      // dd($Countdata);

      return view('Auction.Home',compact('data','Countdata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // dd($request->ClosePriceShow);
        $data = datacar::where('id',$id)->first();
          if ($request->ClosePriceShow != Null) {
            $data->CloseBit_car = str_replace (",","",$request->get('ClosePriceShow'));
          }
            $data->OpenBit_car = str_replace (",","",$request->get('OpenPriceShow'));
        $data->update();

      $idSearch = $id + 1;

      // dd($data->CloseBit_car != 0);
      return redirect()->Route('SearchAuction',$idSearch)->with('success','อัพเดทข้อมูลเรียบร้อย');
      //
      // if ($request->get('ClosePriceShow') != Null or $data->CloseBit_car != 0) {
      //   return redirect()->Route('ReportAuction',$id)->with('success','อัพเดทข้อมูลเรียบร้อย');
      // }else {
      //   return redirect()->Route('SearchAuction',$idSearch)->with('success','อัพเดทข้อมูลเรียบร้อย');
      // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ReportAuction(Request $request, $id)
    {
        dd($request->input( 'name' ));

        $dataReport = DB::table('datacars')
                        ->where('datacars.id',$id)->first();

        dd($dataReport);

        $view = \View::make('Auction.ReportAuction' ,compact('dataReport'));
        $html = $view->render();
        $pdf = new PDF();
        $pdf::SetTitle('รายงานนำเสนอ');
        $pdf::AddPage('L', 'A4');
        $pdf::SetMargins(5, 5, 5, 0);
        $pdf::SetFont('freeserif', '', 8, '', true);
        $pdf::SetAutoPageBreak(TRUE, 25);

        $pdf::WriteHTML($html,true,false,true,false,'');
        $pdf::Output('report.pdf');
    }
}
