#!/bin/sh

PIDFILE=/Applications/MAMP/tmp/mongodb/mongod.pid

if [[ -f $PIDFILE ]]
then
	/Applications/MAMP/Library/bin/mongo --quiet --eval "db.getSiblingDB('admin').shutdownServer()"
	rm -f $PIDFILE
	rm -f /Applications/MAMP/tmp/mongodb/mongod*.sock
	rm -f /Applications/MAMP/db/mongodb/mongod.lock
fi
