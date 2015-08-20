#!/usr/bin/env bash

if [ "${TRAVIS_BRANCH}" = "master" ] && [ "${TRAVIS_PULL_REQUEST}" = "false" ]; then
    git push gitdepl@flaiker.com:depl/kcms-dev
fi
