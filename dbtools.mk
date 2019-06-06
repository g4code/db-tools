# g4/db-tools related targets
# include this into project's makefile with
#    include vendor/g4/db-tools/dbtools.mk

db: db-clean db-migrate

db-clean: environment db-drop db-create db-import

db-create: environment
	@/bin/echo -e "${TITLE} create database..." \
	&& php vendor/g4/db-tools/bin/tools.php create:database env=$(env) ini=${APPLICATION_INI} ruckusing_dir=${RUCKUSING_DIR} \
	&& /bin/echo -e "${TITLE} database created"

db-drop:
	@/bin/echo -e "${TITLE} drop database..." \
	&& php vendor/g4/db-tools/bin/tools.php drop:database env=$(env) ini=${APPLICATION_INI}  ruckusing_dir=${RUCKUSING_DIR} \
	&& /bin/echo -e "${TITLE} database dropped"

db-import:
	@/bin/echo -e "${TITLE} import data from source..." \
	&& php vendor/g4/db-tools/bin/tools.php import:data env=$(env) sql-dump=${ND_API_SQL_DUMP} ini=${APPLICATION_INI} ruckusing_dir=${RUCKUSING_DIR} \
	&& /bin/echo -e "${TITLE} data imported"

db-migrate: environment
	@/bin/echo -e "${TITLE} migrating database..." \
	&& php vendor/g4/db-tools/bin/ruckus.php db:migrate env=$(env) ini=${APPLICATION_INI} ruckusing_dir=${RUCKUSING_DIR} \
	&& /bin/echo -e "${TITLE} database migrated"

db-migrate-version: environment
	@/bin/echo -e "${TITLE} migrating database..." \
	&& php vendor/g4/db-tools/bin/ruckus.php db:migrate VERSION=$(VERSION) env=$(env) ini=${APPLICATION_INI}  ruckusing_dir=${RUCKUSING_DIR} \
	&& /bin/echo -e "${TITLE} database migrated"

db-migrate-down: environment
	@/bin/echo -e "${TITLE} migrating database..." \
	&& php vendor/g4/db-tools/bin/ruckus.php db:migrate VERSION=-1 env=$(env) ini=${APPLICATION_INI}  ruckusing_dir=${RUCKUSING_DIR} \
	&& /bin/echo -e "${TITLE} database migrated"

db-re-migrate: environment
	@/bin/echo -e "${TITLE} rollback all migrations..." \
	&& php vendor/g4/db-tools/bin/ruckus.php db:migrate VERSION=-1000000000 env=$(env) ini=${APPLICATION_INI}  ruckusing_dir=${RUCKUSING_DIR} \
	&& /bin/echo -e "${TITLE} rollback done" \
	&& cd - \
	&& $(MAKE) db-migrate

db-migration-new: environment
	@/bin/echo -e "${TITLE} create new migration script...${APPLICATION_INI}" \
	&& php vendor/g4/db-tools/bin/ruckus.php nd:generateplatformspecific $(name) env=$(env) ini=${APPLICATION_INI}  ruckusing_dir=${RUCKUSING_DIR} \
	&& /bin/echo -e "${TITLE} new migration script created"

db-migration-status: environment
	@/bin/echo -e "${TITLE} checking status of database migrations..." \
	&& php vendor/g4/db-tools/bin/ruckus.php db:status $(name) env=$(env) ini=${APPLICATION_INI} ruckusing_dir=${RUCKUSING_DIR} \
	&& /bin/echo -e "${TITLE} status end."


help-db:
	@  /bin/echo -e "${TITLE} Database related commands ..." \
	&& /bin/echo -e "Database import commands:" \
	&& /bin/echo -e "db                     Create and populate database." \
	&& /bin/echo -e "db-drop                Drop database." \
	&& /bin/echo -e "db-create              Only create database." \
	&& /bin/echo -e "db-clean               Reinitialize database." \
	&& /bin/echo -e "db-import              Import initial database from \"${CURDIR}/$(ND_API_SQL_DUMP)\".\n" \
	&& /bin/echo -e "Misc commands:" \
	&& /bin/echo -e "environment  attribute-migrate \n" \
	&& /bin/echo -e "Migration commands:" \
	&& /bin/echo -e "db-migration-new       Create new migration. Execute migration with db-migrate" \
	&& /bin/echo -e "db-migration-status    Check migration status." \
	&& /bin/echo -e "db-migrate             Migrate all pending migrations." \
	&& /bin/echo -e "db-migrate-down        Migrate one migration DOWN." \
	&& /bin/echo -e "db-migrate-version     Migrate to specific version. Add parametar VERSION=<version number>" \
	&& /bin/echo -e "db-remigrate           Execute all migrations again."

