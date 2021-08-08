<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function() {
    \Artisan::call('config:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('config:cache');
    \Artisan::call('view:clear');
    return 'FINISHED';
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/listado', 'CategoryController@index')->name('category.index');
Route::get('/listado/{slug}', 'CategoryController@listCategory')->name('category.listCategory');
Route::get('/listado/{slug}/subcategoria/{id}', 'CategoryController@listSubCategory')->name('category.listSubCategory');

Route::get('/listado/voto/{id}', 'ServiceController@vote')->name('service.vote');

Route::get('/servicio/{slug}/referencia/{ref}', 'ServiceController@service')->name('service');

Route::post('/busqueda/{location?}/{service?}', 'SearchController@search')->name('search');

Route::post('/servicio/enviar-mensaje', 'MessageController@sendMessage')->name('message.send');

Route::view('/terminos', 'web.parts.termAndCondition')->name('terms');
Route::view('/politicas', 'web.parts.policy')->name('policy');
Route::view('/contacto', 'web.parts.contact')->name('contact');

Route::post('/contacto/enviar', 'EmailController@contactMail')->name('contactMail');
Route::post('/contacto/servicio-enviar', 'EmailController@contactServiceMail')->name('contactServiceMail');

//admin client
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'adminUser\DashboardController@index')->name('dashboard.index');

    Route::get('/dashboard/anunciate/{id}', 'adminUser\DashboardController@changeType')->name('dashboard.changeType');

    Route::get('/dashboard/cliente', 'adminUser\DashboardController@profile')->name('dashboard.clientProfile');
    Route::post('/dashboard/cliente/modificar/{id}', 'adminUser\ProfileController@updateProfile')->name('profile.updateProfile');
    Route::post('/dashboard/cliente/modificar-password', 'adminUser\ProfileController@updatePassword')->name('profile.updatePassword');
    Route::post('/dashboard/cliente/newsletters', 'adminUser\ProfileController@updateNewsLetters')->name('profile.updateNewsLetters');
    
    
    Route::get('/crear-servicio', 'adminUser\ServiceController@createService')->name('service.create');
    Route::get('/crear-servicio/categoria-seleccionada', 'adminUser\ServiceController@createServiceCategoySelect')->name('service.createCategoySelect');
    Route::post('/agregar-servicio', 'adminUser\ServiceController@storeService')->name('service.store');
    Route::get('/pendiente-servicio', 'adminUser\ServiceController@pendingService')->name('service.pending');
    Route::get('/eliminar-foto/{id}', 'adminUser\ServiceController@deletePhoto')->name('service.deletePhoto');

    Route::post('/agregar-comentario/{service}', 'CommentController@storeComment')->name('comment.store');

    Route::get('/listar-servicios', 'adminUser\ServiceController@listServices')->name('service.list');
    Route::get('/editar-servicio/{id}', 'adminUser\ServiceController@editService')->name('service.edit');
    Route::post('/editar-servicio/{id}/actualizar', 'adminUser\ServiceController@updateService')->name('service.update');
    Route::get('/eliminar-servicio/{id}', 'adminUser\ServiceController@deleteService')->name('service.delete');
    
    Route::get('/mensajes', 'adminUser\MessageController@listMessage')->name('message.list');
    Route::get('/mensajes/responder/{id}', 'adminUser\MessageController@responseMessage')->name('message.response');
    Route::post('/mensajes/responder/email', 'EmailController@responseMessageSendEmail')->name('message.responseSendEmail');
    Route::get('/mensajes/eliminar/{id}', 'adminUser\MessageController@deleteMessage')->name('message.delete');
    
    Route::get('/favoritos', 'adminUser\FavoriteController@listFavorite')->name('favorite.list');
    Route::get('/favoritos/{id}', 'adminUser\FavoriteController@deleteFavorite')->name('favorite.delete');
    Route::get('/favoritos/agregar/{id}', 'adminUser\FavoriteController@addFavorite')->name('favorite.add');
});

Route::middleware(['auth','AdminSite'])->group(function () {
    Route::get('/admin/dashboard', 'adminSite\DashboardController@dashboard')->name('adminDashboard.index');

    Route::get('/admin/activar-servicio/{id}', 'adminSite\ServiceController@serviceActive')->name('adminService.active');
    Route::get('/admin/desactivar-servicio/{id}', 'adminSite\ServiceController@serviceDesactive')->name('adminService.desactive');
    Route::get('/admin/borrar-servicio/{id}', 'adminSite\ServiceController@serviceDelete')->name('adminService.delete');

    Route::get('/admin/generar-sitemap', 'adminSite\DashboardController@sitemap')->name('adminDashboard.sitemap');
});