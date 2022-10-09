@ECHO OFF

@REM @echo ALIASES=%ALIASES%

if "%*" == "off" (
    @REM @echo ALIASES=%ALIASES%
    @REM @echo Params: %*
    doskey host= 
    doskey pd= 
    doskey wd=cd %CD% 
    doskey com=composer $*
    doskey art=
    @set ALIASES=
    setlocal enabledelayedexpansion
    @echo ALIASES=!ALIASES!
    exit /b
) 

@REM if "%ALIASES%" == "" (
if "%*" == "" if not defined ALIASES (
    doskey ..=cd ..  
    doskey host=cd C:\op\domains 
    doskey pd=cd C:\php 
    doskey wd=cd %CD% 
    @REM doskey com=@php "C:\Users\ivanl\Documents\vl\php\php-8.1\composer.phar" '%*'
    doskey com=composer $*
    doskey art=artisan $*
    @set ALIASES=on
    setlocal enabledelayedexpansion
    @REM @echo ALIASES=!ALIASES!
)
@echo ALIASES=%ALIASES%
exit /b