<?php

// All Deployer recipes are based on `recipe/common.php`.
require 'vendor/deployer/deployer/recipe/symfony.php';

// Define a server for deployment.
// Let's name it "prod" and use port 22.
server('prod', 'bouchardm.com', 22)
    ->user('root')
    ->password()
    ->stage('production')
    ->env('deploy_path', '/www/vision'); // Define the base path to deploy your project to.

task('deploy:assetic:dump', function() {

});

set('repository', 'git@github.com:bouchardm/vision-board.git');