# db-tools

Usage

Inside project folder, it's required to create this set of folders

```text
db/
  dumps/ 
  logs/
  migrations/
    default/
```
Root folder may be configured with parameter `ruckusing_dir`.

Command line has some required options:

```
 ini - Relative path to application.ini which contain's database configuration files
 env - Environment which will be read from application.ini
 sql-dump - Relative path to SQL file that needs to be imported
 ruckusing_dir - dir name of where database and migration related files are
```

Example:

```text
php vendor/g4/db-tools/bin/tools.php import:data env=$(env) sql-dump=${ND_API_SQL_DUMP} ini=${APPLICATION_INI} ruckusing_dir=${RUCKUSING_DIR}
```

```text
php vendor/g4/db-tools/bin/ruckus.php db:status env=$(env) ini=${APPLICATION_INI} ruckusing_dir=${RUCKUSING_DIR}
```

This variables should be defined inside Makefile like:

```
APPLICATION_INI  = application/setup/config/application.ini
RUCKUSING_DIR    = db
ND_API_SQL_DUMP  = $(RUCKUSING_DIR)/dumps/nd_api_v1.0.0.sql
GEONAME_SQL_DUMP = $(RUCKUSING_DIR)/dumps/geoname.compact.sql
```