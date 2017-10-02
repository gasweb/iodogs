Iodogs
=======================

Introduction
------------
This is a simple, skeleton application using the ZF2 MVC layer and module
systems. This application is meant to be used as a starting place for those
looking to get their feet wet with ZF2.

Installation using Composer
---------------------------

Doctrine console usage
---------------------------
Command for creation entity from database



команда для обновления entity (добавляет getters, setters)
php ./vendor/doctrine/doctrine-module/bin/doctrine-module orm:generate-entities ./module/IodogsDoctrine/src/ --generate-annotations=true

--Команда для создания Entity из базы данных
php ./vendor/doctrine/doctrine-module/bin/doctrine-module orm:convert-mapping --namespace="IodogsDoctrine\Entity\\" --force  --from-database annotation ./module/IodogsDoctrine/src/

--Команда для вадлидации схемы базы данных (проверки соответствия схемы и entity)
php /vendor/bin/doctrine-module orm:validate-schema
