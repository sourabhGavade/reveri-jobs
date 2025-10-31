<?php

Route::get('cms/{slug}', 'CmsController@getPage')->name('cms');
Route::get('terms-of-use', 'CmsController@termsOfUse')->name('terms.of.use');
Route::get('contact-us', 'ContactController@index')->name('contact.us');
Route::post('contact_us', 'ContactController@postContact')->name('contact.us.post');
Route::get('contact-us-thanks', 'ContactController@thanks')->name('contact.us.thanks');
