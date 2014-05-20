#!/bin/bash

# This file is part of the OXID module certification tool licensed under GPLv3 (http://www.gnu.org/licenses)
# @copyright (C) OXID eSales AG 2003-2014

# init declaration
declare MODULEPATH
declare OUTPUTPATH
declare RESULT
declare FILE
declare -i POINTER=0
declare -i LOC=0
declare LINESOFOCCURENCE
declare LINEOFOCCURENCE
declare -a DIRSTOCHECK
DIRSTOCHECK=(controllers components core models)

MODULEPATH=$1
OUTPUTPATH=$2
RESULT=success

# logfile creation
LOGFILE=$OUTPUTPATH"/method_length.xml"
if [ -f $LOGFILE ]
then
rm $LOGFILE
fi
touch $LOGFILE

for DIR in ${DIRSTOCHECK[@]}
do
    if [ ! -d ${MODULEPATH}${DIR} ]; then
        continue
    fi
    for FILE in $(find ${MODULEPATH}${DIR} -type f -name *.php -not -iwholename 'test' )
    do
        POINTER=0
        LINESOFOCCURENCE=`grep -n "public function \|public static function \|protected function \|private function " $FILE |cut -f1 -d:`
        for LINEOFOCCURENCE in $(echo $LINESOFOCCURENCE); do
            let LOC=$LINEOFOCCURENCE-$POINTER

            if [[ "$LOC" -gt 120 ]] && [[ "$POINTER" -gt 0 ]]; then
                    echo "<failure>File "${FILE}" in ${MODULEPATH}${DIR} contains methods with more than 120 LOC</failure>"  >> $LOGFILE
                    RESULT=failure
            elif [[ "$LOC" -gt 90 ]] && [[ "$POINTER" -gt 0 ]]; then
                    echo "<failure>File "${FILE}" in ${MODULEPATH}${DIR} contains methods with more than 90 LOC</failure>"  >> $LOGFILE
                    if [[ $RESULT != "failure" ]]; then
                        RESULT=warning
                    fi
            fi
            POINTER=$LINEOFOCCURENCE
        done;
    done
done
echo "</failures>"  >> $LOGFILE
echo "</result>"  >> $LOGFILE


# Beginning
echo "<failures>" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<result type=\"$RESULT\">" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" | cat - $LOGFILE > temp && mv temp $LOGFILE
