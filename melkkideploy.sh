#!/bin/bash

rsync -z -h -r . maot@melkki.cs.helsinki.fi:~/tsoha/
ssh maot@melkki.cs.helsinki.fi "bash ~/tsoha/deploy.sh"

echo "Valmis!"
