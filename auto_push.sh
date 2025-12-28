#!/bin/bash

if ! [ -d .git ]
    then 
         echo "Not a git repository"
         exit 1
fi

Branch=$(git branch | grep '*' | awk '{print $2}')

git pull origin $Branch
if [ $? -ne 0 ] 
    then 
         echo -e "Merge conflict, it cannot be resolved automatic. \n Please fix it manually."
         exit 1
fi

git add .
message="Auto commit: $(date)"
git commit -m "$message"
if [ $? -eq 0 ] 
    then
        git push origin $Branch
        echo "Code pushed successfully"
fi