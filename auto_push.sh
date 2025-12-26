#!/bin/bash

if ! [ -d .git ]
    then 
         echo "Not a git repository"
         exit 0
fi

git add .
Branch=$(git branch | grep '*' | awk '{print $2}')
message="Auto commit: $(date)"
git commit -m "$message"
if [ $? -eq 0 ] 
    then
        git push origin $Branch
        echo "Code pushed successfully"
fi