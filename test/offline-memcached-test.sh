#!/bin/bash
parent_path=$( cd "$(dirname "${BASH_SOURCE[0]}")" ; pwd -P )
cd "$parent_path"
../vendor/bin/phpunit --bootstrap ../vendor/autoload.php --testdox offline-memcached-test
