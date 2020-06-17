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

Route::get('moveupdown/{id}', 'BudgetController@moveupdown');
Route::get('moveupdown2/{id}/{dir}', 'BudgetController@moveupdown2');

Route::get('acc/{id?}', 'BudgetController@acc');
Route::get('getrows2/{id}', 'BudgetController@getRow2');

Route::post('acc/{id}', 'BudgetController@acc');
Route::post('row2budget/{id}', 'BudgetController@row2Budget');

Route::get('time', 'BudgetController@getTime');

Route::get('edit/{id}', 'BudgetController@editRow');
Route::post('edit/{id}', 'BudgetController@editRowUpdate');

Route::post('move/{id}', 'BudgetController@row2Budget');
Route::post('deleterow2/{id}', 'BudgetController@deleteRow2');
