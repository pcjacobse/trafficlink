FROM istareldritch/datomic-pro-base

MAINTAINER Ruben Paz "me@ruben.io"

COPY transactor.properties $DATOMIC_HOME/transactor.properties
RUN ln -sf /data $DATOMIC_HOME/data

CMD ./bin/transactor transactor.properties

EXPOSE 4334 4335 4336
