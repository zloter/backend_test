# Back-end Recruitment test

## Start project
* Download this repository
* run `composer install`
* run `yarn install`
* compile assets `yarn encore dev`

## Features

This project have only one feature: finding out max value for specific sequence.

You can use sequence form on`/` url or command line:

`./bin/console app:sequence 5 10`

or, using standard input:

`cat your_cases_file.txt | ./bin/console app:sequence`

you can test up to 10 cases at time. 