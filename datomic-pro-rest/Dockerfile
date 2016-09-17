FROM istareldritch/datomic-pro-base

ENV ORIGINS "localhost"
ENV URIS "dev datomic:dev://datomicdb:4334/"

MAINTAINER Ruben Paz "me@ruben.io"

CMD ./bin/rest -p 8001 -o $ORIGINS $URIS

EXPOSE 8001
