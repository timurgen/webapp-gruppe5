<?php
/***
 * Her defineres alle variabler som er felles i hele applikasjonen
 * denne fila skal inkluderes i alle andre filer som kobler seg for eksempel mot database
 */
//navn eller adresse til DB tjener
$DB_SERVER = "kark.hin.no";
//brukernavn som brukes vet kobling til DB tjener
$DB_USER = "gruppe5";
//passord som brukes vet kobling til DB tjener
$DB_PASS = "gruppe5.2012";
//navn til database
$DB_NAME = 'gruppe5';
//salt til brukerpassord
$SALT = 'Rjk56JH8';
//min lengde av passord
$PASS_MIN_LENGTH = 6;
//navn til logfil
$LOGFILE = "log.txt";
?>
