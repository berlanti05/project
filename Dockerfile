FROM ubuntu
RUN apt update
RUN apt install -y apache2 php libapache2-mod-php php-mysql
RUN apt clean
RUN echo "DirectoryIndex index.php index.html" > /etc/apache2/mods-enabled/dir.conf
COPY ./Lavender_website/ /var/www/html/
WORKDIR /var/www/html
EXPOSE 80
CMD ["/usr/sbin/apachectl", "-D", "FOREGROUND"]
