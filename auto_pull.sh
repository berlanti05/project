#!/bin/bash

if ! [ -d .git ]
then
    echo "Not a git repository"
    exit 0
fi

Branch=$(git branch | grep '*' | awk '{print $2}')
git pull origin $Branch
if [ $? -eq 0 ]
then
    echo "Code pulled successfully"
fi
