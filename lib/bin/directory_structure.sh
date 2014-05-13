#!/bin/bash

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
#admins log settings   config  lib  xml  controller  licenses

MODULEPATH=$1
OUTPUTPATH=$2
RESULT=success

# logfile creation
LOGFILE=$OUTPUTPATH"/directory.log"
if [ -f $LOGFILE ]
then
rm $LOGFILE
fi
touch $LOGFILE

MODULEDIRS=`ls -l --time-style="long-iso" $MODULEPATH | egrep '^d' | awk '{print $8}'`

for f in $MODULEDIRS
do
    if(! in_array ALLOWEDDIRS ${f} )
    then
        echo "<failure>Directory "${f}" is not allowed</failure>"  >> $LOGFILE
        RESULT=warning
    fi
done
echo "</failures>"  >> $LOGFILE
echo "</result>"  >> $LOGFILE

##Beginning

echo "<failures>" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<result type=\"$RESULT\">" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" | cat - $LOGFILE > temp && mv temp $LOGFILE

