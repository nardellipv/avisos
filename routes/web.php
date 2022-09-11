<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function() {
    \Artisan::call('config:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('config:cache');
    \Artisan::call('config:clear');
    \Artisan::call('view:cache');
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
Route::get('/servicio/desactivo', 'ServiceController@desactiveService')->name('service.desactive');

// aprobar
Route::get('/activar-servicio-mail/{id}/{ref}', 'ServiceController@serviceActiveEmail')->name('adminService.activeByEmail');
Route::get('/activar-servicio-mail-destacado/{id}/{ref}', 'ServiceController@serviceActiveEmailSponsor')->name('adminService.activeByEmailSponsor');

Route::post('/busqueda/{location?}/{service?}', 'SearchController@search')->name('search');
Route::get('/listado/localidad/{slug}', 'SearchController@listLocation')->name('search.listLocation');

Route::post('/servicio/enviar-mensaje', 'MessageController@sendMessage')->name('message.send');

Route::post('/alta/news-letter', 'NewsLetterController@addEmail')->name('newsLetter.addEmail');

Route::view('/terminos', 'web.parts.termAndCondition')->name('terms');
Route::view('/politicas', 'web.parts.policy')->name('policy');
Route::view('/contacto', 'web.parts.contact')->name('contact');

Route::post('/contacto/enviar', 'EmailController@contactMail')->name('contactMail');
Route::post('/contacto/servicio-enviar', 'EmailController@contactServiceMail')->name('contactServiceMail');

//Job Site
Route::get('/service-end-date', 'JobSiteController@serviceEndDate')->name('jobService.endDate');
Route::get('/service-change-status', 'JobSiteController@serviceChangeStatus')->name('jobService.changeStatus');
Route::get('/complete-profile', 'JobSiteController@completeProfile')->name('jobService.completeProfile');
Route::get('/message-not-read', 'JobSiteController@messageNotRead')->name('jobService.messageNotRead');
Route::get('/resume-client', 'JobSiteController@resumeClient')->name('jobService.resumeClient');
Route::get('/register-user', 'JobSiteController@registerUser')->name('jobService.registerUser');
Route::get('/highlight-service', 'JobSiteController@highlightService')->name('jobService.highlightService');
Route::get('/admin/generar-sitemap-auto', 'adminSite\DashboardController@sitemap')->name('adminDashboard.sitemap');


//admin client
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'adminUser\DashboardController@index')->name('dashboard.index');

    Route::get('/dashboard/anunciate/{id}', 'adminUser\DashboardController@changeType')->name('dashboard.changeType');

    Route::get('/dashboard/cliente', 'adminUser\DashboardController@profile')->name('dashboard.clientProfile');
    Route::get('/dashboard/datos-personales/{id}/{name}', 'adminUser\DashboardController@personalData')->name('dashboard.personalData');
    Route::post('/dashboard/cliente/modificar/{id}', 'adminUser\ProfileController@updateProfile')->name('profile.updateProfile');
    Route::post('/dashboard/cliente/modificar-password', 'adminUser\ProfileController@updatePassword')->name('profile.updatePassword');
    Route::post('/dashboard/cliente/newsletters', 'adminUser\ProfileController@updateNewsLetters')->name('profile.updateNewsLetters');
    
    
    Route::get('/crear-servicio', 'adminUser\ServiceController@createService')->name('service.create');
    Route::get('/crear-servicio/categoria-seleccionada', 'adminUser\ServiceController@createServiceCategoySelect')->name('service.createCategoySelect');
    Route::post('/agregar-servicio', 'adminUser\ServiceController@storeService')->name('service.store');
    Route::get('/pendiente-servicio', 'adminUser\ServiceController@pendingService')->name('service.pending');
    Route::get('/eliminar-foto/{id}', 'adminUser\ServiceController@deletePhoto')->name('service.deletePhoto');
    Route::get('/republicar-servicio/{id}', 'adminUser\ServiceController@republishService')->name('service.republish');

    Route::get('/destacar-info', 'adminUser\PriceController@highlightInfo')->name('info.highlight');
    Route::get('/destacar-servicio/{id}', 'adminUser\PriceController@highlightService')->name('service.highlight');

    Route::post('/agregar-comentario/{service}', 'CommentController@storeComment')->name('comment.store');

    Route::get('/listar-servicios', 'adminUser\ServiceController@listServices')->name('service.list');
    Route::get('/editar-servicio/{id}', 'adminUser\ServiceController@editService')->name('service.edit');
    Route::post('/editar-servicio/{id}/actualizar', 'adminUser\ServiceController@updateService')->name('service.update');
    Route::get('/eliminar-servicio/{id}', 'adminUser\ServiceController@deleteService')->name('service.delete');
    
    Route::get('/mensajes', 'adminUser\MessageController@listMessage')->name('message.list');
    Route::post('/mensajes/responder/{id}', 'adminUser\MessageController@responseMessage')->name('message.response');
    // Route::get('/mensajes/responder/email', 'EmailController@responseMessageSendEmail')->name('message.responseSendEmail');
    Route::get('/mensajes/eliminar/{id}', 'adminUser\MessageController@deleteMessage')->name('message.delete');
    
    Route::get('/favoritos', 'adminUser\FavoriteController@listFavorite')->name('favorite.list');
    Route::get('/favoritos/{id}', 'adminUser\FavoriteController@deleteFavorite')->name('favorite.delete');
    Route::get('/favoritos/agregar/{id}', 'adminUser\FavoriteController@addFavorite')->name('favorite.add');
});

//Admin
Route::middleware(['auth','AdminSite'])->group(function () {
    Route::get('/admin/dashboard', 'adminSite\DashboardController@dashboard')->name('adminDashboard.index');
    
    Route::post('/admin/daysPublic', 'adminSite\DashboardController@changeDaysService')->name('adminDashboard.changeDaysService');
    
    Route::get('/admin/listado', 'adminSite\ServiceController@serviceList')->name('adminService.list');
    Route::post('/admin/activar-servicio/{id}', 'adminSite\ServiceController@serviceActive')->name('adminService.active');
    Route::post('/admin/activar-servicio-destacado/{id}', 'adminSite\ServiceController@serviceSponsorActive')->name('adminService.sponsorActive');
    Route::get('/admin/desactivar-servicio/{id}', 'adminSite\ServiceController@serviceDesactive')->name('adminService.desactive');
    Route::get('/admin/borrar-servicio/{id}', 'adminSite\ServiceController@serviceDelete')->name('adminService.delete');
    Route::get('/admin/reactivar-servicios', 'adminSite\ServiceController@serviceReactivate')->name('adminService.reactivate');

    Route::get('/admin/generar-sitemap', 'adminSite\DashboardController@sitemap')->name('adminDashboard.sitemap');
    Route::get('/admin/incrementar-visitas', 'adminSite\DashboardController@incrementService')->name('adminDashboard.incrementService');

    Route::get('/admin/servicio-pendiente/{slug}/referencia/{ref}', 'ServiceController@servicePending')->name('adminDashboard.servicePending');

    Route::get('/admin/notificaciones/', 'adminSite\NotificationController@listNotification')->name('adminNotification.listNotification');
    Route::post('/admin/crear-notificacion/', 'adminSite\NotificationController@createNotification')->name('adminNotification.createNotification');

    Route::get('/admin/exportar-usuarios/', 'adminSite\ExportController@exportAllUsers')->name('exports.exportAllUsers');
    Route::get('/admin/exportar-anunciantes/', 'adminSite\ExportController@exportAnnun')->name('exports.exportAnnun');
    Route::get('/admin/exportar-clientes/', 'adminSite\ExportController@exportClient')->name('exports.exportClient');
    
    Route::get('/admin/listado-mensajes/', 'adminSite\MessageController@listAdminMessage')->name('AdminMessage.list');
    Route::get('/admin/eliminar-mensajes/{id}', 'adminSite\MessageController@deleteAdminMessage')->name('AdminMessage.delete');
});