<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App;

class BudgetController extends Controller
{
  // GET home
  public function index() {
    $dirpath='../..';$proj=[];foreach(\File::directories($dirpath) as $project){$prj=str_replace($dirpath.'/','',$project);if(substr($prj,0,1)!='_'){$proj[]=ucwords($prj);}}

    // Get codes:
    $codesall=App\Code::orderBy('code')->get(['code','info']);
    foreach($codesall as $code) {$codes[$code->code]="{$code->code}";}

    // 
    $rows=\App\Budget::oldest('date')->get(['id','code', 'description', 'incoming', 'outgoing', 'notes', 'date']);

    $incoming  = ($rows[0]->outgoing=='0.00' && $rows[0]->incoming!='0.00') ? 1 : 0;
    $outgoing  = ($rows[0]->outgoing!='0.00' && $rows[0]->incoming=='0.00') ? 1 : 0;
    if (!$incoming && !$outgoing) {
      $incoming = 0;
      $outgoing = 1;
    } // End if.
    $amount = ($incoming) ? $rows[0]->incoming : $rows[0]->outgoing ;
    
    // Get budget rows.
    $rows2=\App\Budget::oldest('date')->get(['id','code', 'description', 'incoming', 'outgoing', 'notes', 'date']);

    return view('welcome')
    ->with('editrows',['code'=>$rows[0]->code,'date'=>\Carbon\Carbon::parse($rows[0]->date)->format('d/m/Y'),'descr'=>$rows[0]->description,'amount'=>$amount,'notes'=>$rows[0]->notes,'incoming'=>$incoming,'outgoing'=>$outgoing])
    ->with('codes', $codes)
    ->with('rows', $rows2)
    ->with('runbal',\App\Current::getLastEntry('runbal'))
    ->with('projlist',$proj)
    ;
  }

  // GET: getrow/id
  public function getRow($rowid=0) {
    if($rowid==0) {
      $rows=\App\Budget::oldest('date')->get(['morder', 'code', 'description', 'incoming', 'outgoing', 'notes', 'date']);
    } else {
      $rows=\App\Budget::where('id',$rowid)->get(['morder', 'code', 'description', 'incoming', 'outgoing', 'notes', 'date']);
    }

    $incoming  = ($rows[0]->outgoing=='0.00' && $rows[0]->incoming!='0.00') ? 1 : 0;
    $outgoing  = ($rows[0]->outgoing!='0.00' && $rows[0]->incoming=='0.00') ? 1 : 0;
    if (!$incoming && !$outgoing) {
      $incoming = 0;
      $outgoing = 1;
    } // End if.
    $amount = ($incoming) ? $rows[0]->incoming : $rows[0]->outgoing ;
  /*
    // 20/01/15: Reorder morders:
    $r2 = $$myclass->link->prepare("SELECT id, morder FROM statements_budget WHERE date=? ORDER BY date, morder");$r2->execute([$db_date]);

    if ($r2->rowCount()>0) {
      $morderc = 1;
      while(list($id2, $db_morder2)=$r2->fetch(PDO::FETCH_NUM)) {
        $r3 = $$myclass->link->prepare("UPDATE statements_budget SET morder=? WHERE id=?");$r3->execute([$morderc, $id2]);
        $morderc++;
      } // End while.
    } // End if.

    // Does date occur more than once in db:
    $r2  = $$myclass->link->prepare("SELECT MIN(morder), MAX(morder) FROM statements_budget WHERE date=?");$r2->execute([$db_date]);
    list($db_min, $db_max) = $r2->fetch(PDO::FETCH_NUM);
    $rw2 = "{$db_min}-{$db_morder}-{$db_max}"  ;
  */

    // Get codes:
    $codesall=App\Code::orderBy('code')->get(['code','info']);
    foreach($codesall as $code) {$codes[$code->code]="{$code->code}";}

    return view('ajax.getrow')
    ->with('codes', $codes)
    ->with('editrows',['code'=>$rows[0]->code,'date'=>\Carbon\Carbon::parse($rows[0]->date)->format('d/m/Y'),'descr'=>$rows[0]->description,'amount'=>$amount,'notes'=>$rows[0]->notes,'incoming'=>$incoming,'outgoing'=>$outgoing])
    ;
  }

  // POST: addrow
  public function addRow() {
    $create=new \App\Budget;
    $create->date = \Carbon\Carbon::now();
    $create->notes = '';
    $create->save();
    return ($create->save()) ? $create->id : 0 ;
  }

  // POST: deleterow/id
  public function deleteRow($rowid) {
    $delete=\App\Budget::where('id',$rowid)->delete();
    $rows2=\App\Budget::oldest('date')->take(1)->get(['id']);
    return $rows2[0]->id; # ID for first entry so it can be focussed.
  }

  // GET: listview
  public function listView() {
    // Get budget rows.
    $rows2=\App\Budget::oldest('date')->get(['id','code', 'description', 'incoming', 'outgoing', 'notes', 'date']);

    return view('ajax.listview')
    ->with('rows',$rows2)
    ->with('runbal',\App\Current::getLastEntry('runbal'))
    ->with('rowcounter',0)
    ;
  }

  // POST: listview/id
  // Complete update and/or get updated matrix html.
  public function listViewUpdate($rowid) {
    $input=Request::all();
    $update=\App\Budget::where('id',$rowid);
    $descr=(empty($input['descr'])) ? '' : $input['descr'];
    $notes=(empty($input['notes'])) ? '' : $input['notes'];
    $strsql = ( ($input['in']!=='false') ) ? [$input['amount'],0] : [0,$input['amount']];
    $update->update(['code'=>$input['code'],'date'=>\Carbon\Carbon::createFromFormat('d/m/Y',$input['date']),'description'=>$descr,'incoming'=>$strsql[0],'outgoing'=>$strsql[1],'notes'=>$notes]);

    // Get budget rows.
    $rows2=\App\Budget::oldest('date')->get(['id','code', 'description', 'incoming', 'outgoing', 'notes', 'date']);

    return view('ajax.listview')
    ->with('rows',$rows2)
    ->with('runbal',\App\Current::getLastEntry('runbal'))
    ->with('rowcounter',0)
    ;
  }

  // POST: duplicaterow/id
  public function duplicateRow($rowid) {
    $create=new \App\Budget;
    $create->date        = \Carbon\Carbon::createFromFormat('d/m/Y',request('date'));
    $create->description = (empty(request('descr'))) ? '' : request('descr');
    $create->notes       = (empty(request('notes'))) ? '' : request('notes');
    $strsql = ( (request('in')!=='false') ) ? [request('amount'),0] : [0,request('amount')];
    $create->incoming    = $strsql[0];
    $create->outgoing    = $strsql[1];
    $create->save();

    return ($create->save()) ? $create->id : 0 ;
  }

  // POST: transfer/id
  public function transfer($rowid) {
    $input=Request::all();
    if (!isset($input['getrow'])){
      $runbal=\App\Current::latest('date')->orderBy('id','desc')->get(['runbal']);
      $runbal2=\App\Budget::where('id',$id)->get(['incoming','outgoing']);
      return $runbal[0]->runbal - $runbal2[0]->outgoing + $runbal2[0]->incoming ;
    }

    $runbal2=\App\Budget::where('id',$id)->get(['date','description','notes','incoming','outgoing']);
    $strsql = ( ($runbal2[0]->incoming>0) ) ? [$runbal2[0]->incoming,0] : [0,$runbal2[0]->outgoing];
    // Transfer to/from Savings account.
    if ($runbal2[0]->description=='ISA Account') {
      $curbal=\App\Saving::latest('date')->orderBy('id','desc')->get(['runbal']);
      $create=new \App\Saving;
      $create->code        = 'TF';
      $create->date        = $runbal2[0]->date;
      $create->description = 'Current';
      $create->notes       = '';
      $create->incoming    = $strsql[1];
      $create->outgoing    = $strsql[0];
      $create->runbal      = $curbal[0]->runbal - $strsql[0];
      $create->save();
    }
    $create=new \App\Current;
    $create->date = $runbal2[0]->date;
    $create->description = (empty($runbal2[0]->description)) ? '' : $runbal2[0]->description;
    $create->notes       = (empty($runbal2[0]->notes)) ? '' : $runbal2[0]->notes;
    $create->incoming    = $strsql[0];
    $create->outgoing    = $strsql[1];
    $create->runbal      = $input['runbal'];
    $create->save();

    return ($create->save()) ? $create->id : 0 ;
  }






}
