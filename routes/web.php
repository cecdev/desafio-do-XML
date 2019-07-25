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

Route::get('/', 'Site\SiteController@index');

Auth::routes();

Route::prefix('painel')->group(function () {
    Route::namespace('Painel')->group(function () {
        Route::get('ajax/datatables/list/companys', 'AjaxController@listDataTablesCompanys')->name('ajax.datatable.list.companys');
        Route::get('ajax/datatables/list/downloads', 'AjaxController@listDataTablesDownloads')->name('ajax.datatable.list.donloads');

        Route::post('ajax/create/downloads', 'AjaxController@createDownloads')->name('ajax.create.control.download');


        Route::get('/', 'PainelController@index')->name('painel');
        Route::get('/downloads', 'PainelController@downloads')->name('painel.dowload');

        Route::get('/empresa/{code}.xml', 'XmlController@showCompanyXML');

        Route::get('/all/xml/company/zip', 'XmlController@makeZipAllCompanysXML')->name('make.zip.companys');
    });
});

