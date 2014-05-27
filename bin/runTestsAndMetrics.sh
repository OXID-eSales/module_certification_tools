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
    echo "Clover file ${CLOVER_LOCATION} does not exist."
    echo "Quit without running metrics"
    exit 0;
fi

if [ ! $CLOVER_LOCATION ]; then
    echo 'No clover.xml file specified, try to run tests and generate it'
    if [ -f ${TESTPATH}"/phpunit.xml" ]; then
        cd ${TESTPATH}
        CLOVER_LOCATION=${BASEPATH}${OUTPUTDIR}'/clover.xml'
        echo 'execute: phpunit --coverage-clover' ${CLOVER_LOCATION}
        $BASEPATH/vendor/bin/phpunit --configuration ${TESTPATH}"/phpunit.xml" --coverage-clover ${CLOVER_LOCATION} ${TESTPATH}
        cd $BASEPATH;
    else
        echo 'no phpunit.xml found in ' ${TESTPATH}
    fi
fi


if [[ -f $CLOVER_LOCATION ]]; then
echo "Execute metrics calculation and generate report file in ${BASEPATH}${OUTPUTDIR} ignoring ${MODULEPATH}/tests/"
COMMAND=sudo php vendor/bin/oxmd $MODULEPATH $CLOVER_LOCATION xml --extension php --exclude ${MODULEPATH}/tests/ --reportfile-xml ${BASEPATH}${OUTPUTDIR}/oxmd-result.xml > /dev/null
else
    echo "quit without running metrics"
    exit 0;
fi
