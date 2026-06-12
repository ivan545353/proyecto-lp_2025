<?php

const APP_URL = 'http://localhost/lab_prog_2025_reales_ivan_backend/public/';
define('APP_URI', $_SERVER['DOCUMENT_ROOT'] . '/lab_prog_2025_reales_ivan_backend/app/');



define('APP_FILE_LOG_ERRORS',   APP_URI.'logs/error.log');
define('APP_FILE_LOG_ACCESS',   APP_URI.'logs/access.log');





//#########################################
// CONTROLADOR Y ACCION POR DEFECTO
//#########################################

const APP_DEFAULT_CONTROLLER = "authentication";
const APP_DEFAULT_ACTION = "index";
const APP_AUTHENTICATION_CONTROLLER = "authentication";
const APP_LOGIN_ACTION = "index";

//#########################################
// MANEJO DE SESIONES
//#########################################

//EN ESTE CAMPO IR A PASSWORD.php en TEST y ver la contraseña hasheada y pegarla en app_token
const APP_TOKEN = '$2y$10$vtyg5oVqDwAnnZzNpa5IFu9MuYwtV5twpq/j541heYTiyTDXGCFeq';


//#########################################
// ACCESO A VISTAS
//#########################################
const ACCESS_RULES = [
    "Administrador" => ["category", "item", "user"],
    "Operador" => ["category", "item"]
];