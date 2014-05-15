#!/bin/bash

# This file is part of the OXID module certification tool licensed under GPLv3 (http://www.gnu.org/licenses)
# @copyright (C) OXID eSales AG 2003-2014

# init declaration
declare MODULEPATH
declare OUTPUTPATH
declare RESULT
declare PREFIX
declare -a DIRSTOCHECK
DIRSTOCHECK=(controllers components core models)
PREFIX=oepl

MODULEPATH=$1
OUTPUTPATH=$2
RESULT=success

# logfile creation
LOGFILE=$OUTPUTPATH"/prefix.xml"
if [ -f $LOGFILE ]
then
rm $LOGFILE
fi
touch $LOGFILE

for e in ${DIRSTOCHECK[@]}
do
    if [ ! -d ${MODULEPATH}${e} ]; then
        continue
    fi
    for f in $(find ${MODULEPATH}${e} -type f -name *.php -not -iwholename 'test')
    do
        a=${f##*/}
        if [ $PREFIX != ${a:0:${#PREFIX}} ]; then
            echo $a
            echo "false"
            echo "<failure>File "${f}" in ${MODULEPATH}${e} doesnt start with Prefix $PREFIX</failure>"  >> $LOGFILE
            RESULT=warning
        fi
    done
done
echo "</failures>"  >> $LOGFILE
echo "</result>"  >> $LOGFILE


##Beginning

echo "<failures>" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<result type=\"$RESULT\">" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" | cat - $LOGFILE > temp && mv temp $LOGFILE
