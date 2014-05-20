#!/bin/bash

# This file is part of the OXID module certification tool licensed under GPLv3 (http://www.gnu.org/licenses)
# @copyright (C) OXID eSales AG 2003-2014

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

# assamble base output path
OUTPUTBASEPATH=${BASEPATH}/result

# change to ouput path, clear if needed and create output path directory
cd ${BASEPATH}
if [ $DELETE ] && [ 'NO' != $DELETE ]; then
echo 'delete old results'
    /bin/rm -r ${OUTPUTBASEPATH} > /dev/null
fi

/bin/mkdir -p ${BASEPATH}${OUTPUTPATH}
