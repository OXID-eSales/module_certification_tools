#!/bin/bash

# This file is part of the OXID module certification tool licensed under GPLv3 (http://www.gnu.org/licenses)
# @copyright (C) OXID eSales AG 2003-2014

# get the call arguments
MODULEPATH=$1
BASEPATH=$2
OUTPUTDIR=$3
CLOVER_LOCATION=$4

# assemble test path
TESTPATH=${MODULEPATH}/tests/

if [ $CLOVER_LOCATION ] && [ ! -f $CLOVER_LOCATION ]
then
    echo "Clover file ${CLOVER_LOCATION} do not exist."
    echo "Quit without running metrics"
    exit 0;
fi

if [ ! $CLOVER_LOCATION ]; then
    cd ${TESTPATH}
    echo 'No clover.xml file found, try to run tests and generate it'
    CLOVER_LOCATION=${BASEPATH}${OUTPUTDIR}'/clover.xml'
    echo 'execute: phpunit --coverage-clover' ${CLOVER_LOCATION}
    phpunit --coverage-clover ${CLOVER_LOCATION}
fi

cd $BASEPATH;
echo "Execute metrics calculation and generate report file in ${BASEPATH}${OUTPUTDIR} ignoring ${MODULEPATH}/tests/"
COMMAND=sudo php lib/oxmd/src/bin/oxmd $MODULEPATH $CLOVER_LOCATION xml --extension php --exclude ${MODULEPATH}/tests/ --reportfile-xml ${BASEPATH}${OUTPUTDIR}/oxmd-result.xml > /dev/null
