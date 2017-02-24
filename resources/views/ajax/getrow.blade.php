<?php
// Retrieves row to display in 'Edit row' section:
// Clicked on a row or first row
//$selrow = (!isset($_GET['rowid'])) ? $rowidsel : $_GET['rowid'];

// Get row info:
$r = $$myclass->link->prepare("SELECT morder, code, description, incoming, outgoing, notes, date, DATE_FORMAT(date, '%d/%m/%Y') AS dt
 FROM statements_budget WHERE id=?");$r->execute([$selrow]);

list($db_morder, $db_tcode, $db_tdescr, $db_tin, $db_tout, $db_notes, $db_date, $db_tdate) = $r->fetch(PDO::FETCH_NUM);
$incoming  = ($db_tout=='0.00' && $db_tin!='0.00') ? 1 : 0;
$outgoing  = ($db_tout!='0.00' && $db_tin=='0.00') ? 1 : 0;
if (!$incoming && !$outgoing) {
  $incoming = 0;
  $outgoing = 1;
} // End if.
$amount = ($incoming) ? $db_tin : $db_tout ;

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

// Get codes:
$r = $$myclass->link->query("SELECT id, code FROM statements_codes ORDER BY code");
$forms = new Forms('', 'POST', ['style'=>'display:inline;']);
$opts = []; while ($rw = $r->fetch(PDO::FETCH_NUM)) { $opts[$rw[1]] = $rw[1]; } // End while.
echo $forms->dropDown('', 'code', $opts, $db_tcode, 1);
echo $forms->textBox2('date',   $db_tdate,  '', ['style'=>'width:6em;', 'title'=>'date'], 0, 1);
echo $forms->textBox2('descr',  $db_tdescr, '', ['style'=>'width:17em;', 'title'=>'description'], 0, 1);
echo $forms->textBox2('amount', $amount,    '', ['style'=>'width:4em;', 'title'=>'amount'], 0, 1);
echo $forms->button('-', ['id'=>'btnZero'], 1);
echo $forms->textBox2('notes', $db_notes, '', ['style'=>'width:30em;', 'title'=>'notes'], 0, 1);
//echo $forms->button('A', array('id'=>'btnA'), 1);
echo '<br><br>';

echo $forms->radioButtonGroup( ['IN'=>'in','OUT'=>'out'], 'inout', (($incoming)?'in':'out') );

echo $forms->button('Update &gt;', ['id'=>'editdata'], 1);
echo $forms->hidden('rowid', '', 1);

$forms->closeform('');
//unset($forms);
if (!isset($dontdance)) {echo "|{$rw2}";}