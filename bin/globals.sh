#!/bin/bash

# This file is part of the OXID module certification tool licensed under GPLv3 (http://www.gnu.org/licenses)
# @copyright (C) OXID eSales AG 2003-2014

# init declaration
declare MODULEPATH
declare OUTPUTPATH
declare RESULT

MODULEPATH=$1
OUTPUTPATH=$2
RESULT=success

# logfile creation
LOGFILE=$OUTPUTPATH"/globals.xml"
if [ -f $LOGFILE ]
then
    rm $LOGFILE
fi
touch $LOGFILE

for FILE in $(find ${MODULEPATH} -type f -name *.php -not -iwholename 'test')
do
            if grep -q '$_POST\|$_GET\|$_SERVER\|$_FILES\|$_COOKIE\|$_SESSION\|$_REQUEST\|$_ENV\|$GLOBALS' $FILE; then
                    echo "<failure>File "${FILE}" uses global variables</failure>"  >> $LOGFILE
                    RESULT=failure
            fi
done
echo "</failures>"  >> $LOGFILE
echo "</result>"  >> $LOGFILE

echo "<failures>" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<result type=\"$RESULT\">" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" | cat - $LOGFILE > temp && mv temp $LOGFILE
