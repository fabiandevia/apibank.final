FROM php:7.1-apache
FROM oraclelinux:7-slim

ARG MYSQL_SERVER_PACKAGE=mysql-community-server-minimal-5.6.44
ARG MYSQL_SHELL_PACKAGE=

# Install server
RUN apt-get install mysql-client mysql-server libapache2-mod-php7.0

VOLUME /var/lib/mysql

COPY docker-entrypoint.sh /entrypoint.sh
COPY healthcheck.sh /healthcheck.sh
ENTRYPOINT ["/entrypoint.sh"]
HEALTHCHECK CMD /healthcheck.sh
EXPOSE 3306
CMD ["mysqld"]
