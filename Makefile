# commands
COMPOSER_CMD=composer
PHPCBF_CMD=phpcbf
PHPCS_CMD=phpcs
PHPUNIT_CMD=phpunit
SECURITY_CHECKER_CMD=security-checker
PHP_CMD=php
SYMFONY_CMD=$(PHP_CMD) bin/console --env=$(SYMFONY_ENV)
# default configuration
SYMFONY_ENV=dev
TARBALL_OPTIONS=

help:                                                                           ## shows this help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_\-\.]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

# targets for the developers
dev-init: composer-install                                                      ## Run all build scripts and import
dev-update: dev-init                                                            ## alias for "dev-init"
dev-check: linters phpunit phpcs

dev-recreate-db:                                                                ## throws away database and recreate it
	-$(SYMFONY_CMD) doctrine:database:drop --force
	$(SYMFONY_CMD) doctrine:database:create
	$(SYMFONY_CMD) doctrine:schema:create

# symfony app related targets
composer-install:                                                               ## the good old composer install
	$(COMPOSER_CMD) install --no-interaction --prefer-dist --optimize-autoloader

database-update-schema:                                                         ## run database migrations
	$(SYMFONY_CMD) doctrine:schema:update --force

cache-clear:                                                                    ## clear symfony cache
	$(SYMFONY_CMD) cache:clear

# test targets
linters:                                                                        ## lint symfony app related sources
	$(SYMFONY_CMD) lint:yaml app
	$(SYMFONY_CMD) lint:yaml src
	$(SYMFONY_CMD) lint:twig app/Resources/views
	find ./src -name "*.php" -print0 | xargs -0 -n1 -P8 php -l

phpunit:                                                                        ## run phpunit tests
	$(PHPUNIT_CMD) $(OPTIONS) -c app

security-checker:                                                               ## check composer dependencies for vulnerabilities
	$(SECURITY_CHECKER_CMD) security:check composer.lock

# Cody analysis targets
phpcs:                                                                          ## run php code style checker
	$(PHPCS_CMD) --standard=phpcs.xml $(OPTIONS)

phpcbf:                                                                         ## run php code style auto-fixer
	-$(PHPCBF_CMD) --standard=phpcs.xml

# report targets
phpunit-report: reports                                                         ## run phpunit and create reports
	$(MAKE) OPTIONS='--coverage-html=reports/phpunit-html-coverage --log-junit=reports/phpunit.junit.xml --coverage-clover=reports/phpunit.clover.xml' phpunit

phpcs-report: reports                                                           ## run php code style checker and create report
	$(MAKE) OPTIONS='--report=checkstyle --report-file=reports/phpcs.cs.xml' phpcs

reports:                                                                        ## create reports directory
	mkdir -p reports

# deployment targets
tarball:                                                                        ## create deployable tarball
	touch minecraft-app.tar.gz
	tar -czf minecraft-app.tar.gz . --exclude ./reports --exclude ./app/cache --exclude ./app/logs --exclude minecraft-app.tar.gz --exclude ./app/config/parameters.yml $(TARBALL_OPTIONS)

.PHONY: help dev-recreate-db
.PHONY: composer-install database-update-schema cache-clear
.PHONY: linters phpunit security-checker phpcs phpcbf tarball
