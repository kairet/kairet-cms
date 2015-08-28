#!/usr/bin/env bash

echo "Setting up ssh"

# Decrypts the deployment key and adds it to the ssh-agent
openssl aes-256-cbc -K $encrypted_7452e89f60ce_key -iv $encrypted_7452e89f60ce_iv -in deplkey.enc -out deplkey -d
chmod 600 deplkey
echo -n -e "Host flaiker.com\n StrictHostKeyChecking no\n IdentityFile $TRAVIS_BUILD_DIR/deplkey" > ~/.ssh/config