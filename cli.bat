@ECHO OFF
@REM @echo ALIASES=%ALIASES%
if not defined ALIASES ( call aliases.bat )
@php "%~dp0cli.php" %*
