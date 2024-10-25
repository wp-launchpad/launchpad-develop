{
  "name": "crochetfeve0251/psr2-plugin",
  "description": "Template for a psr2 compatible plugin",
  "keywords": [
    "wordpress"
  ],
  "license": "GPL-2.0-or-later",
  "authors": [
    {
      "name": "CrochetFeve0251"
    }
  ],
  "type": "wordpress-plugin",
  "config": {
    "sort-packages": true,
    "preferred-install": {
      "wp-media/phpunit": "source"
    },
    "process-timeout": 0,
    "allow-plugins": {
      "composer/installers": true,
      "mnsami/composer-custom-directory-installer": true,
      "dealerdirect/phpcodesniffer-composer-installer": true
    }
  },
  "repositories": [
    {
      "type": "composer",
      "url": "https://wpackagist.org"
    },
    {
      "type": "git",
      "url": "git@github.com:CrochetFeve0251/psr2-plugin-builder.git"
    }
  ],
  "require": {
    "php": ">=7.0",
    "berlindb/core": "^2.0",
    "composer/installers": "^1.0 || ^2.0",
    "monolog/monolog": "^1.0"
  },
  "require-dev": {
    "php": "^7 || ^8",
    "brain/monkey": "^2.0",
    "coenjacobs/mozart": "^0.7",
    "dealerdirect/phpcodesniffer-composer-installer": "^0.7.0",
    "league/container": "^3.3",
    "mnsami/composer-custom-directory-installer": "^2.0",
    "phpcompatibility/phpcompatibility-wp": "^2.0",
    "phpstan/phpstan": "^0.12",
    "phpunit/phpunit": "^7.5 || ^8 || ^9",
    "psr/container": "1.0.0",
    "roave/security-advisories": "dev-master",
    "szepeviktor/phpstan-wordpress": "^0.7.0",
    "wp-coding-standards/wpcs": "^2",
    "wp-media/phpunit": "^3.0",
    "crochetfeve0251/psr2-plugin-builder": "dev-main"
  },
  "autoload": {
    "classmap": [
      "inc/classes"
    ],
    "psr-4": {
      "PSR2Plugin\\": "inc/"
    }
  },
  "autoload-dev": {
    "psr-4": {
      "PSR2Plugin\\Tests\\": "tests/"
    }
  },
  "extra": {
    "installer-paths": {
      "vendor/{$vendor}/{$name}/": ["type:wordpress-plugin"]
    },
    "mozart": {
      "dep_namespace": "PSR2Plugin\\Dependencies\\",
      "dep_directory": "/inc/Dependencies/",
      "classmap_directory": "/inc/classes/dependencies/",
      "classmap_prefix": "PSR2Plugin_",
      "packages": [
        "berlindb/core",
        "league/container"
      ]
    }
  },
  "scripts": {
    "test-unit": "\"vendor/bin/phpunit\" --testsuite unit --colors=always --configuration tests/Unit/phpunit.xml.dist",
    "test-integration": "\"vendor/bin/phpunit\" --testsuite integration --colors=always --configuration tests/Integration/phpunit.xml.dist --exclude-group AdminOnly",
    "test-integration-adminonly": "\"vendor/bin/phpunit\" --testsuite integration --colors=always --configuration tests/Integration/phpunit.xml.dist --group AdminOnly",
    "run-tests": [
      "@test-unit",
      "@test-integration",
      "@test-integration-adminonly"
    ],
    "run-stan": "vendor/bin/phpstan analyze --memory-limit=2G --no-progress",
    "install-codestandards": "Dealerdirect\\Composer\\Plugin\\Installers\\PHPCodeSniffer\\Plugin::run",
    "phpcs": "phpcs --basepath=.",
    "phpcs-changed": "./bin/phpcs-changed.sh",
    "phpcs:fix": "phpcbf",
    "post-install-cmd": [
      "\"vendor/bin/mozart\" compose",
      "composer dump-autoload"
    ],
    "post-update-cmd": [
      "\"vendor/bin/mozart\" compose",
      "composer dump-autoload"
    ],
    "code-coverage": "\"vendor/bin/phpunit\" --testsuite unit --colors=always --configuration tests/Unit/phpunit.xml.dist --coverage-clover=tests/report/coverage.clover"
  },
  "minimum-stability": "stable",
  "prefer-stable": true
}
