<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    // Get codes:
  $codesall=App\Code::orderBy('code')->get(['code','info']);
  foreach($codesall as $code) {$codes[$code->code]="{$code->code}";}

    $rows=\App\Budget::oldest('date')->get(['morder', 'code', 'description', 'incoming', 'outgoing', 'notes', 'date']);



  return view('welcome')
  ->with('editrows',['code'=>$rows[0]->code,'date'=>\Carbon\Carbon::parse($rows[0]->date)->format('d/m/Y')])
  ->with('codes', $codes)
  ;
});

Route::get('getrow/{id?}', function ($rowid=0) {
  if($rowid==0) {
    $rows=\App\Budget::oldest('date')->get(['morder', 'code', 'description', 'incoming', 'outgoing', 'notes', 'date']);
  } else {
    $rows=\App\Budget::find($rowid)->get(['morder', 'code', 'description', 'incoming', 'outgoing', 'notes', 'date']);
  }

  $incoming  = ($rows[0]->incoming=='0.00' && $rows[0]->incoming!='0.00') ? 1 : 0;
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
  ->with('editrows',['code'=>$rows[0]->code,'date'=>\Carbon\Carbon::parse($rows[0]->date)->format('d/m/Y')])
  ->with('codes', $codes);
});
