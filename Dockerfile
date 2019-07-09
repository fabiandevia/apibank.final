FROM php:7.1-apache
FROM oraclelinux:7-slim

# Install server
RUN sudo apt-get install mysql-client mysql-server

VOLUME /var/lib/mysql

COPY docker-entrypoint.sh /entrypoint.sh
COPY healthcheck.sh /healthcheck.sh
ENTRYPOINT ["/entrypoint.sh"]
HEALTHCHECK CMD /healthcheck.sh
EXPOSE 3306
CMD ["mysqld"]
