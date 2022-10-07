FROM jenkins/jenkins:lts

USER root

RUN apt update
RUN apt -y install apt-transport-https lsb-release ca-certificates curl wget
RUN wget https://packages.sury.org/php/apt.gpg
RUN apt-key add apt.gpg
RUN sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
RUN apt update
RUN apt-get install -y php7.2 php7.2-mbstring php7.2-xml php7.2-bcmath php7.2-mysql php7.2-redis php7.2-zip php7.2-gd
RUN apt-get install -y php7.2-pgsql 

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN composer self-update --1
