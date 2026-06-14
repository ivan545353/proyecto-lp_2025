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
const APP_LOGIN_ACTION = "login";
const JWT_SECRET = '2896bd45d7c219ccec38199c54734628';
const JWT_EXPIRATION = 3600; // 1 hora

//#########################################
// MANEJO DE SESIONES
//#########################################

eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c3VhcmlvSUQiOjEsImN1ZW50YSI6Iml2YW41NDUzIiwicGVyZmlsIjoiQWRtaW5pc3RyYWRvciIsImNvcnJlbyI6Iml2YW41NDUzNTNAZ21haWwuY29tIiwiaWF0IjoxNzgxMzk2NTgxLCJleHAiOjE3ODE0MDAxODF9.w-GDbWgCVNAB4A1PnJ1qm1YiGQUMhgWAeRPafZG1_4o.tFlcE9U6Di-KOzqeKnhBVahsozbWODU-tgc5uxyEfW4

