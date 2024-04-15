#!/bin/bash

# docker-compose
alias start="docker-compose up -d nginx mysql phpmyadmin redis workspace"
alias stop="docker-compose stop"
alias remove="docker-compose down -v"

