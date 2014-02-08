ZendSkeletonApplication
=======================

Einleitung
------------
Das ist bis jetzt eine einfache Zend-Framework 2 Anwendung. 
Sie stellt die Grundfunktionen zum Speichern/Bearbeiten/Löschen von Artikel und Nutzerdaten zur verfügung.
Bei der Passwortverschlüsselung wird auf den sha512-Standard gesetzt.
Ein Datenbankabbild wird unter "data/db/database.sql" zur Verfügung gestellt.
Das Zend Framework 2 ist nicht mit eingebunden, das kann jedoch wie bei der Installation beschrieben nachgeladen werden.

Im laufe der Zeit sollen hier immer mehr Module entstehen, die euch Entwicklern die Arbeit erleichtern sollen.

Also dann viel Spaß mit meinen Demomodulen!

Installation
------------

Mit dem Composer
----------------------------
Empfohlen wird es das ZF2 mit dem Composer zu installieren. Den kann man direkt von https://getcomposer.org heruntergeladen werden.
Mit der folgenden Konsolenzeile kann man dann das ZF2 herunterladen. Dabei handelt es sich um die skeleton-application, die sich direkt in das Projekt hier eingliedern wird.
    
	php composer.phar create-project -sdev --repository-url="https://packages.zendframework.com" zendframework/skeleton-application path/to/install

Alternativ kann man es sich auch direkt von Github herunter laden.
   http://github.com/zendframework/ZendSkeletonApplication

Man sollte nach der Installation von ZF2 direkt ein "php composer.phar self-update" ausführen, damit man auch mit der aktuellsten Version vom ZF2 arbeitet.

Web Server Setup
----------------

Ich würde das Webserverpaket von XAMPP empfehlen, es ist einfach zu installieren und konfigurieren. Es ist erhältlich für Windows xyz, MaxOs und Linux unter:

http://www.apachefriends.org/de/download.html

### Apache Setup

Im Unterordner von xampp findet man dann eine httpd-vhosts.conf diese liegt in "xampp/apache/conf/extra/". Hier sollte der folgende XmL-Block ergänzt werden.

    <VirtualHost *:80>
        ServerName zf2-tutorial.localhost
        DocumentRoot /path/to/zf2-tutorial/public
        SetEnv APPLICATION_ENV "development"
        <Directory /path/to/zf2-tutorial/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>
