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