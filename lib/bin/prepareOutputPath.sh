#!/bin/bash

# get parameter from command line
BASEPATH=$1
OUTPUTPATH=$2
DELETE=$3

# check for required parameters
if [ ! ${BASEPATH} ] || [ ! ${OUTPUTPATH} ]; then
    echo "************************************************"
    echo "|  Module Certification Tool "
    echo "|  Output Path Preparation "
    echo "|  by OXID eSALES AG 2014 "
    echo "************************************************"
    echo "|  Usage: "
    echo "|  prepareOutputPath.sh <run.sh script path> <name of output path> "
    echo "************************************************"
    echo ""
fi

# get base output path
OUTPUTBASEPATH=${BASEPATH}/output

# change to ouput path, clear if needed and create new actual timestamp as name
cd ${BASEPATH}
if [ $DELETE ]; then
    /bin/rm -r ${OUTPUTBASEPATH} > /dev/null
fi

echo  ${BASEPATH}
/bin/mkdir -p ${BASEPATH}${OUTPUTPATH}
