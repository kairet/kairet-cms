#!/usr/bin/env bash

if [ "${TRAVIS_TAG}" != "" ]; then
    echo "Deploying to stable"
    git push gitdepl@flaiker.com:depl/kcms
fi
