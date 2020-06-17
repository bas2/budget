<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use \App;

use Carbon\Carbon;

class BudgetController extends Controller
{
  // GET home
  public function index() {



    // 
    $rows = App\Budget::oldest('date')->orderby('morder')
    ->get(['id','code', 'description', 'incoming', 'outgoing', 'notes', 'date'])->first();
 
    $incoming  = ($rows->outgoing=='0.00' && $rows->incoming!='0.00') ? 1 : 0;
    $outgoing  = ($rows->outgoing!='0.00' && $rows->incoming=='0.00') ? 1 : 0;
    if (!$incoming && !$outgoing) {
      $incoming = 0;
      $outgoing = 1;
    } // End if.
    $amount = ($incoming) ? $rows->incoming : $rows->outgoing ;
    
    // Get budget rows.
    $rows2 = App\Budget::oldest('date')->orderBy('morder')
    ->get(['id','code', 'description', 'incoming', 'outgoing', 'notes', 'date']);
    return view('welcome')
    ->with('editrows',['code' => $rows->code,'date' => Carbon::parse($rows->date)->format('d/m/Y'),
    'descr' => $rows->description, 'amount' => $amount, 'notes' => $rows->notes,
    'incoming' => $incoming, 'outgoing' => $outgoing])
    
    ->with('rows', $rows2)
    ->with('runbal', App\Current::getLastEntry('runbal'))
    ->with('latestID', App\Budget::oldest('date')->take(1)->get(['id'])[0]->id)
    ->with('account_numbers', ['Current'=>'C ' . App\Current::$account_number, 
    'Savings'=>'S ' . App\Saving::$account_number])
    ->with('last_entries', 
    ['CurrentDate' => Carbon::parse(App\Current::getLastEntry('date'))->format('d/m/Y'), 
    'CurrentAmount' => App\Current::getLastEntry('amount'), 
    'CurrentDescr' => App\Current::getLastEntry('description'), 
    'SavingsDate' => Carbon::parse(App\Saving::getLastEntry('date'))->format('d/m/Y'), 
    'SavingsAmount' => App\Saving::getLastEntry('amount'), 
    'SavingsDescr' => App\Saving::getLastEntry('description')])
    ->with('running_balances', [
    'Current' => number_format(App\Current::getLastEntry('runbal'),2), 
    'Savings' => number_format(App\Saving::getLastEntry('runbal'),2), 
    'Total' => number_format(App\Current::getLastEntry('runbal') + App\Saving::getLastEntry('runbal'),2)])
    //->with('projlist',$proj)
    ;
  }


  // GET: getrow/id
  public function getRow($rowid=0) {
    if($rowid==0) {
      $rows=\App\Budget::oldest('date')
      ->get(['morder', 'code', 'description', 'incoming', 'outgoing', 'notes', 'date'])->first();
    } else {
      $rows=\App\Budget::where('id',$rowid)
      ->get(['morder', 'code', 'description', 'incoming', 'outgoing', 'notes', 'date'])->first();
    }

    $incoming  = ($rows->outgoing=='0.00' && $rows->incoming!='0.00') ? 1 : 0;
    $outgoing  = ($rows->outgoing!='0.00' && $rows->incoming=='0.00') ? 1 : 0;
    if (!$incoming && !$outgoing) {
      $incoming = 0;
      $outgoing = 1;
    } // End if.
    $amount = ($incoming) ? $rows->incoming : $rows->outgoing ;
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
    ->with('editrows',['code'=>$rows->code,'date'=>Carbon::parse($rows->date)->format('d/m/Y'),
    'descr'=>$rows->description,'amount'=>$amount,'notes'=>$rows->notes,'incoming'=>$incoming,'outgoing'=>$outgoing])
    ;
  }


  // POST: addrow
  public function addRow() {
    $create=new \App\Budget;
    $create->date = Carbon::now();
    $create->notes = '';
    $create->save();
    return ($create->save()) ? $create->id : 0 ;
  }


  // POST: deleterow/id
  public function deleteRow($rowid) {
    $delete=\App\Budget::where('id',$rowid)->delete();

    $rows2=\App\Budget::oldest('date')->orderby('morder')->take(1)->get(['id'])->first();
    return $rows2->id; # ID for first entry so it can be focussed.
  }


  // GET: listview
  public function listView() {
    // Get budget rows.
    $rows2=\App\Budget::oldest('date')->orderBy('morder')
    ->get(['id','code', 'description', 'incoming', 'outgoing', 'notes', 'date']);

    return view('ajax.listview')
    ->with('rows',$rows2)
    ->with('runbal',\App\Current::getLastEntry('runbal'))
    ->with('rowcounter',0)
    ;
  }

  // New function to return highest morder plus one for a date:
  public function morderplusone($date)
  {
    $morder = \App\Budget::where('date', $date)
    ->orderBy('morder', 'desc')
    ->take(1)
    ->get(['morder']);
    if ($morder->count() == 0)
    {
      return 0;
    } else 
    {
      return $morder->first()->morder + 1;
    }

  }


  // POST: listview/id
  // Complete update and/or get updated matrix html.
  public function listViewUpdate($rowid) {
    $date = explode(' ', Carbon::createFromFormat('d/m/Y',request('date')));
    // Only alter morder to the end if date changes.
    $date2 = \App\Budget::where('id', $rowid)->get(['date', 'morder'])->first();
    //return $date[0] . ' ' . $date2->date ;
    $changed = ( $date[0] == $date2->date ) ? $date2->morder : $this->morderplusone($date[0]) ;
    //return $changed;

    $update=\App\Budget::where('id',$rowid);
    $descr=(empty(request('descr'))) ? '' : request('descr');
    $notes=(empty(request('notes'))) ? '' : request('notes');
    $strsql = ( (request('in')!=='false') ) ? [request('amount'),0] : [0,request('amount')];
    $update->update(['code'=>request('code'),'date'=>$date[0],
    'morder'=>$changed,'description'=>$descr,
    'incoming'=>$strsql[0],'outgoing'=>$strsql[1],'notes'=>$notes]);

    // Get budget rows.
    $rows2=\App\Budget::oldest('date')->orderBy('morder')
    ->get(['id','code', 'description', 'incoming', 'outgoing', 'notes', 'date']);

    return view('ajax.listview')
    ->with('rows',$rows2)
    ->with('runbal',\App\Current::getLastEntry('runbal'))
    ->with('rowcounter',0)
    ;
  }

  // Function to create a row in Budget table:
  public function createBudgetRow($values)
  {
    $create=new \App\Budget;
    $create->date        = $values[0];
    $create->description = $values[1];
    $create->notes       = $values[2];
    $create->incoming    = $values[3];
    $create->outgoing    = $values[4];
    $create->morder      = $values[5];
    $create->save();

    return $create;
  }

  // POST: duplicaterow/id
  public function duplicateRow($rowid) {
    $row=\App\Budget::where('id',$rowid)
    ->get(['date','description','notes','incoming','outgoing'])
    ->first();

    $create = $this->createBudgetRow([ $row->date, (empty($row->description)) ? '' : $row->description, 
    (empty($row->notes)) ? '' : $row->notes, $row->incoming, $row->outgoing, $this->morderplusone($row->date) ]);

    return ($create->save()) ? $create->id : 0 ;
  }

  
  // POST: transfer/id
  public function transfer($rowid) {
    if ( null == request('getrow') ) {
      $runbal=\App\Current::latest('date')->orderBy('id','desc')->get(['runbal'])->first();
      $runbal2=\App\Budget::where('id',$rowid)->get(['incoming','outgoing'])->first();
      return $runbal->runbal - $runbal2->outgoing + $runbal2->incoming ;
    }

    $runbal2=\App\Budget::where('id',$rowid)
    ->get(['date','description','notes','incoming','outgoing'])
    ->first();
    $strsql = ( ($runbal2->incoming>0) ) ? [$runbal2->incoming,0] : [0,$runbal2->outgoing];
    // Transfer to/from Savings account.
    if ($runbal2->description=='ISA Account') {
      $curbal=\App\Saving::latest('date')->orderBy('id','desc')->get(['runbal'])->first();
      $create=new \App\Saving;
      $create->code        = 'TF';
      $create->date        = $runbal2->date;
      $create->description = 'Current';
      $create->notes       = '';
      $create->incoming    = $strsql[1];
      $create->outgoing    = $strsql[0];
      $create->runbal      = $curbal->runbal - $strsql[0];
      $create->save();
    }

    $create=new \App\Current;
    $create->date = $runbal2->date;
    $create->description = (empty($runbal2->description)) ? '' : $runbal2->description;
    $create->notes       = (empty($runbal2->notes)) ? '' : $runbal2->notes;
    $create->incoming    = $strsql[0];
    $create->outgoing    = $strsql[1];
    $create->runbal      = request('runbal');
    $create->save();

    return ($create->save()) ? request('runbal') : 0 ;
  }

  // Given current rowID, return whether there are rows above or below to swap with.
  public function moveupdown($rowid)
  {
    // To be able to move a row up, there needs to be a row with a lower ID and same morder.
    $row = \App\Budget::where('id', $rowid)->get(['date'])->first();
    $rows = \App\Budget::where('date', $row->date)->orderby('morder')->get(['id']);

    $data = []; $ids = 0;
    foreach ($rows as $row)
    {
      $update = \App\Budget::where('id', $row->id);
      $data[$row->id] = $ids;
      $update->update(['morder'=>$ids]);
      $ids++;
    }
    $morder = $data[$rowid];
    $up   = ($morder == 0)        ? 1 : 0 ;
    $down = ($morder == ($ids-1)) ? 1 : 0 ;

    if ($ids <= 1) return "0|0|0";
    else if ($ids == 2) return "2|$up|$down";
    else if ( $ids > 2 && $morder == 0 ) return "$ids|$up|$down";
    else if ( $ids > 2 && ($morder > 0 && $morder < ($ids - 1)) ) return "$ids|1|1";
    else if ( $ids > 2 && $morder == ($ids - 1) ) return "$ids|$up|$down";

    //return "$ids|$up|$morder";
  }

  // Alter morder for row to move up or down.
  public function moveupdown2($rowid, $dir='u')
  {
    // Assume the direction of up:
    // We basically need to swap morders with the one the row is moving places with.
    // 1. Get morder for the row that is moving:
    $row = \App\Budget::where('id', $rowid)->get(['morder', 'date'])->first();
    $curmorder      = $row->morder;
    $rowdate        = $row->date;

    $moveupmorder   = $curmorder - 1;
    $movedownmorder = $curmorder + 1;
    // 2. Get the morder for the row we're swapping with. This will depend on whether wer're 
    // moving the row up or down.
    
    // Instead, for moving a row up, we'll decrease the selected  by one and increase the row it's 
    // swapping by one. Simples!

    $row2 = \App\Budget::where('date', $rowdate)->where('morder', $moveupmorder)->get(['id'])->first();
    $id2 = $row2->id;

    $row = \App\Budget::where('id', $rowid)->update(['morder'=>$moveupmorder]);
    $row = \App\Budget::where('id', $id2)->update(['morder'=>$curmorder]);

    return $rowid;
    //return "Row moved. morder for $rowid is now $moveupmorder and the other is $curmorder.";
  }


  public function acc($rowid=0)
  {

    if ($rowid > 0)
    {
      // Update row:
      $latest_id = $rowid;
      $update=\App\Current::where('id',$rowid);
      $runbal=(empty(request('runbal'))) ? 0 : request('runbal');     
      $descr=(empty(request('descr'))) ? '' : request('descr');
      $notes=(empty(request('notes'))) ? '' : request('notes');
      $strsql = ( (request('in')!=='false') ) ? [request('amount'),0] : [0,request('amount')];
      $update->update(['code'=>request('code'),'date'=>Carbon::createFromFormat('d/m/Y',request('date')),
      'runbal'=>$runbal,
      'description'=>$descr,'incoming'=>$strsql[0],'outgoing'=>$strsql[1],'notes'=>$notes]);
    }
    else {
      $latest_id = App\Current::orderby('date', 'desc')->orderby('id', 'desc')->take(1)->get(['id'])[0]->id;
    }

    $rows = App\Current::orderby('date', 'desc')->orderby('id', 'desc')->take(100)->get();

    $rows2 = App\Current::where('id', $latest_id)->take(100)
    ->get(['incoming', 'outgoing', 'code', 'date', 'description', 'notes', 'runbal'])->first();

    $incoming  = ($rows2->outgoing=='0.00' && $rows2->incoming!='0.00') ? 1 : 0;
    $outgoing  = ($rows2->outgoing!='0.00' && $rows2->incoming=='0.00') ? 1 : 0;
    if (!$incoming && !$outgoing) {
      $incoming = 0;
      $outgoing = 1;
    } // End if.
    $amount = ($incoming) ? $rows2->incoming : $rows2->outgoing ;

    // Get codes:
    $codesall=App\Code::orderBy('code')->get(['code','info']);
    foreach($codesall as $code) {$codes[$code->code]="{$code->code}";}
    
    return view('ajax.acc')
    ->with('codes', $codes)
    ->with('rows', $rows)
    ->with('latestID', $latest_id)
    ->with('editrows2', ['code'=>$rows2->code,'date'=>Carbon::parse($rows2->date)->format('d/m/Y'),
    'descr'=>$rows2->description,'amount'=>$amount,'notes'=>$rows2->notes,'incoming'=>$incoming,
    'outgoing'=>$outgoing,'runbal'=>$rows2->runbal])
    ->with('rowcounter',0)
    ; // $acc;
  }

  public function getRow2($id)
  {

    $rows2 = App\Current::where('id', $id)
    ->get(['code', 'date', 'description', 'runbal', 'notes', 'incoming', 'outgoing'])->first();

    $incoming  = ($rows2->outgoing=='0.00' && $rows2->incoming!='0.00') ? 1 : 0;
    $outgoing  = ($rows2->outgoing!='0.00' && $rows2->incoming=='0.00') ? 1 : 0;
    if (!$incoming && !$outgoing) {
      $incoming = 0;
      $outgoing = 1;
    } // End if.
    $amount = ($incoming) ? $rows2->incoming : $rows2->outgoing ;

    // Get codes:
    $codesall=App\Code::orderBy('code')->get(['id','code','info']);
    foreach($codesall as $code) {$codes[$code->code]="{$code->code}";}

    return view('ajax.getrow2')
    ->with('codes', $codes)
    ->with('latest_id', $id)
    ->with('editrows2',['id'=>$rows2->id,'code'=>$rows2->code,
    'date'=>Carbon::parse($rows2->date)->format('d/m/Y'),
    'descr'=>$rows2->description,'amount'=>$amount,'notes'=>$rows2->notes,'incoming'=>$incoming,
    'outgoing'=>$outgoing,'runbal'=>$rows2->runbal]);
  }

  public function row2update()
  {
    return 'test';
  }

  public function row2Budget($rowid)
  {
    // 1. Get info for Current account row to be moved back.
    $row=\App\Current::where('id',$rowid)->get()->first();

    // 2. Create row in Budget
    $create = $this->createBudgetRow([ $row->date, (empty($row->description)) ? '' : $row->description, 
    (empty($row->notes)) ? '' : $row->notes, $row->incoming, $row->outgoing, $this->morderplusone($row->date) ]);
  }


    // POST: deleterow/id
    public function deleteRow2($rowid) {
      $delete=\App\Current::where('id',$rowid)->delete();
  
      //$rows2=\App\Current::oldest('date')->orderby('morder')->take(1)->get(['id'])->first();
      //return $rows2->id; # ID for first entry so it can be focussed.
      return $rowid;
    }

    /*
     * Return current time.
     * GET: time
     */
    public function getTime()
    {
        return date('H:i') . ' / ' . date('D j M');
    }

    /*
     * GET: edit/id
    */
    public function editRow($id)
    {
      $rows = App\Budget::where('id', $id)
      ->get(['id','code', 'description', 'incoming', 'outgoing', 'notes', 'date'])->first();
      $incoming  = ($rows->outgoing=='0.00' && $rows->incoming!='0.00') ? 1 : 0;
      $outgoing  = ($rows->outgoing!='0.00' && $rows->incoming=='0.00') ? 1 : 0;
      if (!$incoming && !$outgoing) {
        $incoming = 0;
        $outgoing = 1;
      } // End if.
      $amount = ($incoming) ? $rows->incoming : $rows->outgoing ;
    // Get codes:
    $codesall = App\Code::orderBy('code')->get(['code','info']);
    foreach($codesall as $code) {$codes[$code->code] = "{$code->code}";}
      return view('ajax.editrow')    ->with('editrows',['code' => $rows->code,'date' => Carbon::parse($rows->date)->format('d/m/Y'),
      'descr' => $rows->description, 'amount' => $amount, 'notes' => $rows->notes,
      'incoming' => $incoming, 'outgoing' => $outgoing])
      ->with('latestID', $id)->with('codes', $codes);
    }

}
