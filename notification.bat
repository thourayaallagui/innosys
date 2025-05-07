@echo off
echo %DATE% %TIME% - Script lancé >> "C:\xampp\htdocs\gresclamation\controller\log.txt"
php C:\xampp\htdocs\gresclamation\controller\notifier.php
