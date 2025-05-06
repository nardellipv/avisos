<?php

use Illuminate\Support\Facades\Route;

Route::get('/clear', function () {
    \Artisan::call('config:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('config:cache');
    \Artisan::call('view:cache');
    \Artisan::call('view:clear');

    $logPath = storage_path('logs/laravel.log');
    if (file_exists($logPath)) {
        file_put_contents($logPath, '');
    }

    return 'FINISHED + LOG LIMPIADO';
});


Auth::routes();

Route::get('login/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallback']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/listado', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
Route::get('/listado/{slug}', [App\Http\Controllers\CategoryController::class, 'listCategory'])->name('category.listCategory');
Route::get('/listado/{slug}/subcategoria/{id}', [App\Http\Controllers\CategoryController::class, 'listSubCategory'])->name('category.listSubCategory');

Route::get('/listado/voto/{id}', [App\Http\Controllers\ServiceController::class, 'vote'])->name('service.vote');

Route::get('/servicio/{slug}/referencia/{ref}', [App\Http\Controllers\ServiceController::class, 'service'])->name('service');
Route::get('/servicio/desactivo', [App\Http\Controllers\ServiceController::class, 'desactiveService'])->name('service.desactive');

// aprobar
Route::get('/activar-servicio-mail/{id}/{ref}', [App\Http\Controllers\ServiceController::class, 'serviceActiveEmail'])->name('adminService.activeByEmail');
Route::get('/activar-servicio-mail-destacado/{id}/{ref}', [App\Http\Controllers\ServiceController::class, 'serviceActiveEmailSponsor'])->name('adminService.activeByEmailSponsor');

Route::post('/busqueda/{location?}/{service?}', [App\Http\Controllers\SearchController::class, 'search'])->name('search');
Route::get('/listado/localidad/{slug}', [App\Http\Controllers\SearchController::class, 'listLocation'])->name('search.listLocation');

Route::post('/servicio/enviar-mensaje', [App\Http\Controllers\MessageController::class, 'sendMessage'])->name('message.send');

Route::post('/alta/news-letter', [App\Http\Controllers\NewsLetterController::class, 'addEmail'])->name('newsLetter.addEmail');

Route::view('/terminos', 'web.parts.termAndCondition')->name('terms');
Route::view('/politicas', 'web.parts.policy')->name('policy');
Route::view('/contacto', 'web.parts.contact')->name('contact');

Route::post('/contacto/enviar', [App\Http\Controllers\EmailController::class, 'contactMail'])->name('contactMail');
Route::post('/contacto/servicio-enviar', [App\Http\Controllers\EmailController::class, 'contactServiceMail'])->name('contactServiceMail');


//Job Site
Route::get('/service-end-date', [App\Http\Controllers\JobSiteController::class, 'serviceEndDate'])->name('jobService.endDate');
Route::get('/miss-you', [App\Http\Controllers\JobSiteController::class, 'missYou'])->name('jobService.missYou');
Route::get('/service-change-status', [App\Http\Controllers\JobSiteController::class, 'serviceChangeStatus'])->name('jobService.changeStatus');
Route::get('/complete-profile', [App\Http\Controllers\JobSiteController::class, 'completeProfile'])->name('jobService.completeProfile');
Route::get('/message-not-read', [App\Http\Controllers\JobSiteController::class, 'messageNotRead'])->name('jobService.messageNotRead');
Route::get('/resume-client', [App\Http\Controllers\JobSiteController::class, 'resumeClient'])->name('jobService.resumeClient');
Route::get('/register-user', [App\Http\Controllers\JobSiteController::class, 'registerUser'])->name('jobService.registerUser');
Route::get('/highlight-service', [App\Http\Controllers\JobSiteController::class, 'highlightService'])->name('jobService.highlightService');
Route::get('/admin/generar-sitemap-auto', [App\Http\Controllers\AdminSite\DashboardController::class, 'sitemap'])->name('adminDashboard.sitemap');
Route::get('/publicar-ig', [App\Http\Controllers\JobSiteController::class, 'publishIG'])->name('publish.instagram');


//admin client
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminUser\DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/dashboard/anunciate/{id}', [App\Http\Controllers\AdminUser\DashboardController::class, 'changeType'])->name('dashboard.changeType');

    Route::get('/dashboard/cliente', [App\Http\Controllers\AdminUser\DashboardController::class, 'profile'])->name('dashboard.clientProfile');
    Route::get('/dashboard/datos-personales/{id}/{name}', [App\Http\Controllers\AdminUser\DashboardController::class, 'personalData'])->name('dashboard.personalData');
    Route::post('/dashboard/cliente/modificar/{id}', [App\Http\Controllers\AdminUser\ProfileController::class, 'updateProfile'])->name('profile.updateProfile');
    Route::post('/dashboard/cliente/modificar-password', [App\Http\Controllers\AdminUser\ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('/dashboard/cliente/newsletters', [App\Http\Controllers\AdminUser\ProfileController::class, 'updateNewsLetters'])->name('profile.updateNewsLetters');

    Route::get('/crear-servicio', [App\Http\Controllers\AdminUser\ServiceController::class, 'createService'])->name('service.create');
    Route::get('/crear-servicio/categoria-seleccionada', [App\Http\Controllers\AdminUser\ServiceController::class, 'createServiceCategoySelect'])->name('service.createCategoySelect');
    Route::post('/agregar-servicio', [App\Http\Controllers\AdminUser\ServiceController::class, 'storeService'])->name('service.store');
    Route::get('/pendiente-servicio', [App\Http\Controllers\AdminUser\ServiceController::class, 'pendingService'])->name('service.pending');
    Route::get('/eliminar-foto/{id}', [App\Http\Controllers\AdminUser\ServiceController::class, 'deletePhoto'])->name('service.deletePhoto');
    Route::get('/republicar-servicio/{id}', [App\Http\Controllers\AdminUser\ServiceController::class, 'republishService'])->name('service.republish');

    Route::get('/destacar-info', [App\Http\Controllers\AdminUser\PriceController::class, 'highlightInfo'])->name('info.highlight');
    Route::get('/destacar-servicio/{id}', [App\Http\Controllers\AdminUser\PriceController::class, 'highlightService'])->name('service.highlight');

    Route::post('/agregar-comentario/{service}', [App\Http\Controllers\CommentController::class, 'storeComment'])->name('comment.store');

    Route::get('/listar-servicios', [App\Http\Controllers\AdminUser\ServiceController::class, 'listServices'])->name('service.list');
    Route::get('/editar-servicio/{id}', [App\Http\Controllers\AdminUser\ServiceController::class, 'editService'])->name('service.edit');
    Route::post('/editar-servicio/{id}/actualizar', [App\Http\Controllers\AdminUser\ServiceController::class, 'updateService'])->name('service.update');
    Route::get('/eliminar-servicio/{id}', [App\Http\Controllers\AdminUser\ServiceController::class, 'deleteService'])->name('service.delete');

    Route::get('/mensajes', [App\Http\Controllers\AdminUser\MessageController::class, 'listMessage'])->name('message.list');
    Route::post('/mensajes/responder/{id}', [App\Http\Controllers\AdminUser\MessageController::class, 'responseMessage'])->name('message.response');
    // Route::get('/mensajes/responder/email', [App\Http\Controllers\EmailController::class, 'responseMessageSendEmail'])->name('message.responseSendEmail');
    Route::get('/mensajes/eliminar/{id}', [App\Http\Controllers\AdminUser\MessageController::class, 'deleteMessage'])->name('message.delete');

    Route::get('/favoritos', [App\Http\Controllers\AdminUser\FavoriteController::class, 'listFavorite'])->name('favorite.list');
    Route::get('/favoritos/{id}', [App\Http\Controllers\AdminUser\FavoriteController::class, 'deleteFavorite'])->name('favorite.delete');
    Route::get('/favoritos/agregar/{id}', [App\Http\Controllers\AdminUser\FavoriteController::class, 'addFavorite'])->name('favorite.add');
});

Route::middleware(['auth', 'AdminSite'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminSite\DashboardController::class, 'dashboard'])->name('adminDashboard.index');

    Route::post('/admin/daysPublic', [App\Http\Controllers\AdminSite\DashboardController::class, 'changeDaysService'])->name('adminDashboard.changeDaysService');

    Route::get('/admin/listado', [App\Http\Controllers\AdminSite\ServiceController::class, 'serviceList'])->name('adminService.list');
    Route::post('/admin/activar-servicio/{id}', [App\Http\Controllers\AdminSite\ServiceController::class, 'serviceActive'])->name('adminService.active');
    Route::post('/admin/activar-servicio-destacado/{id}', [App\Http\Controllers\AdminSite\ServiceController::class, 'serviceSponsorActive'])->name('adminService.sponsorActive');
    Route::get('/admin/desactivar-servicio/{id}', [App\Http\Controllers\AdminSite\ServiceController::class, 'serviceDesactive'])->name('adminService.desactive');
    Route::get('/admin/borrar-servicio/{id}', [App\Http\Controllers\AdminSite\ServiceController::class, 'serviceDelete'])->name('adminService.delete');
    Route::get('/admin/editar-servicio/{id}', [App\Http\Controllers\AdminSite\ServiceController::class, 'serviceEdit'])->name('adminService.edit');
    Route::post('/admin/update-servicio/{id}', [App\Http\Controllers\AdminSite\ServiceController::class, 'serviceUpdate'])->name('adminService.update');
    Route::get('/admin/reactivar-servicios', [App\Http\Controllers\AdminSite\ServiceController::class, 'serviceReactivate'])->name('adminService.reactivate');
    Route::post('/admin/generar-publicacion', [App\Http\Controllers\AdminSite\DashboardController::class, 'publicationMake'])->name('publication.make');

    Route::get('/admin/generar-sitemap', [App\Http\Controllers\AdminSite\DashboardController::class, 'sitemap'])->name('adminDashboard.sitemap');
    Route::get('/admin/incrementar-visitas', [App\Http\Controllers\AdminSite\DashboardController::class, 'incrementService'])->name('adminDashboard.incrementService');

    Route::get('/admin/servicio-pendiente/{slug}/referencia/{ref}', [App\Http\Controllers\ServiceController::class, 'servicePending'])->name('adminDashboard.servicePending');

    Route::get('/admin/notificaciones/', [App\Http\Controllers\AdminSite\NotificationController::class, 'listNotification'])->name('adminNotification.listNotification');
    Route::post('/admin/crear-notificacion/', [App\Http\Controllers\AdminSite\NotificationController::class, 'createNotification'])->name('adminNotification.createNotification');

    Route::get('/admin/exportar-usuarios/', [App\Http\Controllers\AdminSite\ExportController::class, 'exportAllUsers'])->name('exports.exportAllUsers');
    Route::get('/admin/exportar-anunciantes/', [App\Http\Controllers\AdminSite\ExportController::class, 'exportAnnun'])->name('exports.exportAnnun');
    Route::get('/admin/exportar-clientes/', [App\Http\Controllers\AdminSite\ExportController::class, 'exportClient'])->name('exports.exportClient');

    Route::get('/admin/listado-mensajes/', [App\Http\Controllers\AdminSite\MessageController::class, 'listAdminMessage'])->name('AdminMessage.list');
    Route::get('/admin/eliminar-mensajes/{id}', [App\Http\Controllers\AdminSite\MessageController::class, 'deleteAdminMessage'])->name('AdminMessage.delete');
});