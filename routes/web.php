<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\GuestGroupController;
use App\Http\Controllers\GuestController;

Route::get('/', [EventController::class, 'index'])->name('home');

Route::resource('events', EventController::class);
Route::resource('invitations', InvitationController::class);
Route::resource('guest-groups', GuestGroupController::class);
Route::resource('guests', GuestController::class);

Route::post('/events/{event}/publish-invitation', [InvitationController::class, 'publish'])->name('invitations.publish');
Route::post('/guest-groups/{guestGroup}/confirm', [GuestGroupController::class, 'confirm'])->name('guest-groups.confirm');
Route::get('/events/{event}/send-reminders', [EventController::class, 'sendReminders'])->name('events.send-reminders');
Route::get('/guest-groups/create/{event}', [GuestGroupController::class, 'create'])->name('guest-groups.create');
Route::post('/guest-groups/store/{event}', [GuestGroupController::class, 'store'])->name('guest-groups.store');
