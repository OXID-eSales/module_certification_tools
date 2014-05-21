#!/bin/bash

# This file is part of the OXID module certification tool licensed under GPLv3 (http://www.gnu.org/licenses)
# @copyright (C) OXID eSales AG 2003-2014

# get parameter from command line
BASEPATH=$1
OUTPUTDIR=$2
DELETE=$3

# check for required parameters
if [ ! ${BASEPATH} ] || [ ! ${OUTPUTDIR} ]; then
    exit 0;
fi

# assamble base output path
OUTPUTBASEPATH=${BASEPATH}/result

# change to output path, clear if needed and create output path directory
cd ${BASEPATH}
if [[ $DELETE ]] && [[ "NO" != $DELETE ]]; then
    if [ -d "$OUTPUTBASEPATH" ]; then
        echo 'delete old results'
        /bin/rm -r ${OUTPUTBASEPATH} > /dev/null
    fi
fi

/bin/mkdir -p ${BASEPATH}${OUTPUTDIR}
