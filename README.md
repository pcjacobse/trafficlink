# Trafficlink visualiser

A simple application to visualise trafficlink data.

The application collects trafficlink data from <http://www.trafficlink-online.nl/trafficlinkdata/wegdata/TrajectSensorsNH.GeoJSON> every 5 minutes.

To view the visualised data goto <http://localhost:8082/> or if deployed remotely <http://remoteserver:8082/>

### Setup

```
cp code/config/autoload/doctrine.local.php.dist code/config/autoload/doctrine.local.php
docker-compose up
```

Optional for debugging:
```
cp code/config/autoload/local.php.dist code/config/autoload/local.php
cp code/config/autoload/errorhandler.php.dist code/config/autoload/errorhandler.local.php
```

###### Remarks

*This application was made in assignment for YourSurprise*

###### References sources
- Zend Expressive CLI setup <https://xtreamwayz.com/blog/2016-02-07-zend-expressive-console-cli-commands>
- Monolog intergration <https://github.com/Orasik/monolog-middleware>
- Doctrine setup <https://xtreamwayz.com/blog/2015-12-12-setup-doctrine-for-zend-expressive>
- RD Coordinate conversion <http://thomasv.nl/2014/03/rd-naar-gps/>