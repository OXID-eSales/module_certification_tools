#!/bin/bash

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

for f in $(find ${MODULEPATH} -type f -name *.php -not -iwholename 'test')
do
            if grep '$_POST\|$_GET\|$_SERVER\|$_FILES\|$_COOKIE\|$_SESSION\|$_REQUEST\|$_ENV\|$GLOBALS' $f; then
                    echo "<failure>File "${f}" uses global variables</failure>"  >> $LOGFILE
                    RESULT=failure
            fi
done
echo "</failures>"  >> $LOGFILE
echo "</result>"  >> $LOGFILE


# Beginning
echo "<failures>" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<result type=\"$RESULT\">" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" | cat - $LOGFILE > temp && mv temp $LOGFILE
