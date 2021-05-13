#!/bin/bash
# C9-PHP7.2-Upgrade
# 
# Created by Ian Manseau
# Source: https://github.com/imanseau/Cloud9-PHP7-Upgrade
#
# Updated by Anthony Iovanna
#
# 
# C9-PHP7-Upgrade is a bash script for a quick and painless upgrade to 
# PHP 7 for cloud9's development platform
# Copyright (C) 2017  Ian Corbitt Manseau
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
# 
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <https://www.gnu.org/licenses/>.

clear

read -p "Do you want to upgrade to PHP 7.2? " -n 1 -r
echo    # (optional) move to a new line
if [[ $REPLY =~ ^[Yy]$ ]]
then
    sudo add-apt-repository ppa:ondrej/php
    sudo apt-get update
    sudo apt-get install libapache2-mod-php7.2 -y
    sudo a2dismod php5
    sudo a2enmod php7.2
    sudo apt-get install php7.2-dom -y
    sudo apt-get install php7.2-mbstring -y
    sudo apt-get install php7.2-zip -y
    sudo apt-get install php7.2-mysql -y
    sudo apt-get install php7.2-curl -y
    sudo apt-get install php7.2-gd -y
    sudo service apache2 restart
    echo "Congragulations you have upgraded your dev box to PHP 7.2"
fi