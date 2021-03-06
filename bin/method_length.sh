#!/bin/bash

# This file is part of the OXID module certification tool licensed under GPLv3 (http://www.gnu.org/licenses)
# @copyright (C) OXID eSales AG 2003-2014

# init declaration
declare MODULEPATH
declare OUTPUTPATH
declare RESULT
declare FILE
declare OLDFILE
declare -i POINTER=0
declare -i LOC=0
declare -i FILELOC=0
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

POINTER=0
FILELOC=0
OLDFILE=""
for DIR in ${DIRSTOCHECK[@]}
do
    if [ ! -d ${MODULEPATH}"/"${DIR} ]; then
        continue
    fi
    for FILE in $(find ${MODULEPATH}"/"${DIR} -type f -name *.php -not -iwholename 'test' )
    do

        if [[ $FILELOC>0 ]];then
            if [[ $((FILELOC-POINTER))>90 ]]; then
                echo "<failure>File "${OLDFILE}" in ${MODULEPATH}/${DIR} contains methods with more than 90 LOC</failure>"  >> $LOGFILE
                RESULT=warning
            elif [[ $((FILELOC-POINTER))>120 ]]; then
                echo "<failure>File "${OLDFILE}" in ${MODULEPATH}/${DIR} contains methods with more than 120 LOC</failure>"  >> $LOGFILE
                RESULT=failure
            fi
        fi
        FILELOC=`grep -cve "^\s*$" ${FILE}`
        POINTER=0
        LINESOFOCCURENCE=`grep -n "public function \|public static function \|protected function \|private function " $FILE |cut -f1 -d:`
        for LINEOFOCCURENCE in $(echo $LINESOFOCCURENCE); do
            let LOC=$LINEOFOCCURENCE-$POINTER

            if [[ "$LOC" -gt 120 ]] && [[ "$POINTER" -gt 0 ]]; then
                    echo "<failure>File "${FILE}" in ${MODULEPATH}/${DIR} contains methods with more than 120 LOC</failure>"  >> $LOGFILE
                    RESULT=failure
            elif [[ "$LOC" -gt 90 ]] && [[ "$POINTER" -gt 0 ]]; then
                    echo "<failure>File "${FILE}" in ${MODULEPATH}/${DIR} contains methods with more than 90 LOC</failure>"  >> $LOGFILE
                    if [[ $RESULT != "failure" ]]; then
                        RESULT=warning
                    fi
            fi
            POINTER=$LINEOFOCCURENCE
        done;
        OLDFILE=$FILE
    done
done
if [[ $((FILELOC-POINTER))>90 ]]; then
  echo "<failure>File "${OLDFILE}" in ${MODULEPATH}/${DIR} contains methods with more than 90 LOC</failure>"  >> $LOGFILE
  RESULT=warning
elif [[ $((FILELOC-POINTER))>120 ]]; then
   echo "<failure>File "${OLDFILE}" in ${MODULEPATH}/${DIR} contains methods with more than 120 LOC</failure>"  >> $LOGFILE
   RESULT=failure
fi
echo "</failures>"  >> $LOGFILE
echo "</result>"  >> $LOGFILE

echo "<failures>" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<result type=\"$RESULT\">" | cat - $LOGFILE > temp && mv temp $LOGFILE
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>" | cat - $LOGFILE > temp && mv temp $LOGFILE
