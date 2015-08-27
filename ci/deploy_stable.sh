#!/usr/bin/env bash

if [ "${TRAVIS_TAG}" != "" ]; then
    git push gitdepl@flaiker.com:depl/kcms
fi
