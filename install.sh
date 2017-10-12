#!/bin/bash

php init --env=Development --overwrite=n
mysqladmin -u root -fp321 create blockchain
php yii migrate --interactive=0
