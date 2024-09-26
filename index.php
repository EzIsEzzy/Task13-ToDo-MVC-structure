<?php
require_once 'autoload/autoload.php';

switch ($PATH) {
    //Front-end Routing
    case $root.'':
    case $root.'home':
        Route::home();
        break;
    case $root.'login':
        Route::login();
        break;
    case $root.'register':
        Route::register();
        break;
    case $root.'homepage':
        Route::homepage();
        break;
    case $root.'notepage':
        Route::notepage();
        break;
    case $root.'profile':
        Route::profile();
        break;
    case $root.'noteupdate?id='.$_GET['id']:
        Route::noteupdate();
        break;
    
    //Back-end Routing
    case $root.'login_back':
        NotesController::Login();
        break;
    case $root.'register_back':
        NotesController::Register();
        break;
    case $root.'logout':
        NotesController::Logout();
        break;
    case $root.'notepage_back':
        NotesController::AddNote();
        break;
    case $root.'noteupdating?id='.$_GET['id']:
        NotesController::UpdateNote();
        break;
    case $root.'notedelete?id='.$_GET['id']:
        NotesController::DeleteNote();
    break;
    case $root.'updateprofile?id='.$_GET['id']:
        NotesController::UpdateProfile();
        break;
    default:
        echo "not here";
        break;
}