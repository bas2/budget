<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saving extends Account
{
  public static $account_number = '24362957'; # ISA: 

  public static function getLastEntry($column) {
    $select=self::latest('date')->latest('id')->get();
    if ($column=='amount') {
      $incoming  = ($select[0]->outgoing=='0.00' && $select[0]->incoming!='0.00') ? 1 : 0;
      $outgoing  = ($select[0]->outgoing!='0.00' && $select[0]->incoming=='0.00') ? 1 : 0;
      if (!$incoming && !$outgoing) {
        $incoming = 0;
        $outgoing = 1;
      } // End if.
      return ($incoming) ? $select[0]->incoming : $select[0]->outgoing ;
    } else {
    return $select[0]->$column;
    }
  }
}
