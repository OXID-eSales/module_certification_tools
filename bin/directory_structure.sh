#!/bin/bash

# This file is part of the OXID module certification tool licensed under GPLv3 (http://www.gnu.org/licenses)
# @copyright (C) OXID eSales AG 2003-2014

#functions
in_array() {
    local HAYSTACK=${1}[@]
    local NEEDLE=${2}
    for i in ${!HAYSTACK}; do
        if [[ ${i} == ${NEEDLE} ]]; then
            return 0
        fi
    done
    return 1
}

# init declaration
declare MODULEPATH
declare OUTPUTPATH
declare RESULT
declare -a MODULEDIRS
declare -a ALLOWEDDIRS
ALLOWEDDIRS=(controllers components core documentation install models out tests translations views)

MODULEPATH=$1
OUTPUTPATH=$2
RESULT=success

# logfile creation
LOGFILE=$OUTPUTPATH"/directory.xml"
if [ -f $LOGFILE ]
then
rm $LOGFILE
fi
touch $LOGFILE

for MODULEDIR in $(find $MODULEPATH -maxdepth 1 -type d )
 do
DIR=${MODULEDIR:${#MODULEPATH}}
if [ ! $DIR ]; then
 continue
fi
if [ ${DIR:0:1} == "/" ]; then
DIR=${DIR: 1}
fi
    if(! in_array ALLOWEDDIRS ${DIR} )
    then
        echo "<failure>Directory \""${DIR}"\" is not allowed</failure>"  >> $LOGFILE
        RESULT=warning
    fi
done
echo "</failures>"  >> $LOGFILE
echo "</result>"  >> $LOGFILE

##Beginning

echo "<failures>" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<result type=\"$RESULT\">" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" | cat - $LOGFILE > temp && mv temp $LOGFILE
