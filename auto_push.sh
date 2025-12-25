#!/bin/bash

git add .
message="Auto commit: $(date)"
git commit -m "$message"
git push origin main
echo "Code pushed successfully"
