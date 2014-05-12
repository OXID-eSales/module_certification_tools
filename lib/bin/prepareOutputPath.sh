#!/bin/bash

# get parameter from command line
BASEPATH=$1
OUTPUTPATH=$2
DELETE=$3

echo 'BASE'
echo ${BASEPATH}
echo 'BASE'
echo ${OUTPUTPATH}
echo 'BASE'
echo ${DELETE}

# when no base path given, get ist by itself
if [ !$BASEPATH ] || [ ! -d $BASEPATH ]; then
    PATH=`pwd`
    PATH=${PATH%/*}
    BASEPATH=${PATH%/*}
fi


# get base output path
OUTPUTPATH=${BASEPATH}/output

# change to ouput path, clear if needed and create new actual timestamp as name
cd ${BASEPATH}
if [ $DELETE ]; then
    /bin/rm -r ${OUTPUTPATH}
fi

echo $DATE
echo $OUTPUTPATH
/bin/mkdir -p ${OUTPUTPATH}
