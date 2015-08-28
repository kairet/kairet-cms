#!/usr/bin/env bash

if [ "${TRAVIS_BRANCH}" = "master" ] && [ "${TRAVIS_PULL_REQUEST}" = "false" ]; then
    echo "Deploying to dev"
    git push gitdepl@flaiker.com:depl/kcms-dev
fi
