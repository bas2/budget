<?php

Route::get('/',               'BudgetController@index');

Route::get('getrow/{id?}',       'BudgetController@getRow');

Route::post('addrow',            'BudgetController@addRow');

Route::post('deleterow/{id}',    'BudgetController@deleteRow');

Route::get('listview',           'BudgetController@listView');
Route::post('listview/{id}',     'BudgetController@listViewUpdate');

Route::post('duplicaterow/{id}', 'BudgetController@duplicateRow');

Route::post('transfer/{id}',     'BudgetController@transfer');

Route::post('getlist', function () {} );
