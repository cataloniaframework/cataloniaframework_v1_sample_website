# CQLSH 4.1 / Cql 3.0
CREATE KEYSPACE cataloniafw
  WITH replication = {'class':'SimpleStrategy', 'replication_factor':1};

# CQL 2
CREATE KEYSPACE cataloniafw
  WITH strategy_class = 'SimpleStrategy'
   AND strategy_options:replication_factor='1';

USE cataloniafw;

# CQLSH 4.1 / Cql 3.0
CREATE TABLE serverstats (vdate varchar,
                          unix_datetime int,
                          node varchar,
                          vname varchar,
                          vvalue varchar,
                          datetime varchar,
             PRIMARY KEY  ((vdate, node, vname), datetime)
                         );
# Read with SELECT * FROM serverstats WHERE vdate='2014-02-01' AND node='CRON01' AND vname='CPU_USED';

# CQL 2
CREATE TABLE serverstats (vdate varchar PRIMARY KEY,
                          unix_datetime,
                          node varchar,
                          vname varchar,
                          vvalue varchar,
                          datetime varchar
                         );

