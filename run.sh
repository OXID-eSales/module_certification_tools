#!/bin/bash

# This file is part of the OXID module certification tool licensed under GPLv3 (http://www.gnu.org/licenses)
# @copyright (C) OXID eSales AG 2003-2014

# init declaration
declare MODULEPATH
declare DELETE_OLD_RUNS
declare BASEPATH
declare OUTPUTDIR
declare CLOVER_LOCATION
declare PREFIX

# getting path information
pushd . > /dev/null
BASEPATH="${BASH_SOURCE[0]}";
if ([ -h "${BASEPATH}" ]); then
  while([ -h "${BASEPATH}" ]); do cd `dirname "$SCRIPT_PATH"`; SCRIPT_PATH=`readlink "${BASEPATH}"`; done
fi
cd `dirname ${BASEPATH}` > /dev/null
BASEPATH=`pwd`;
popd  > /dev/null

# loading config file
if [ ! -f "${BASEPATH}/config.cfg" ]; then
  echo " ! ERROR: config file is not found, stops executing"
  exit 0;
fi
.  "${BASEPATH}/config.cfg"

############insert here functionality to determine the path of output directory
DATE=$(/bin/date +%Y%m%d%H%M%S)
OUTPUTDIR=/result/${DATE}

#var settings
if [ -z "$MODULEPATH" ]; then MODULEPATH=$CFG_MODULEPATH; fi
CLOVER_LOCATION=$CFG_CLOVER_LOCATION
DELETE_OLD_RUNS=$CFG_DELETE_OLD_RUNS
PREFIX=$CFG_PREFIX

if [ ${MODULEPATH: -1} == "/" ]; then
    MODULEPATH=${MODULEPATH%?}
fi

if [ ! -d ${MODULEPATH} ]; then
  echo "ERROR: Modulepath incorrect! Please take a look into your config.cfg and edit CFG_MODULEPATH "
  exit 0;
fi

# options
while getopts ":dh" opt
  do
    case "$opt" in
      "d")
        DELETE_OLD_RUNS=true
        echo "Option 'delete' is specified, script will now remove unused result sets."
        ;;
      "h")
        echo ""
        echo "************************************************"
        echo "|  Module Certification Tool "
        echo "|  by OXID eSALES AG 2014 "
        echo "************************************************"
        echo "|  The following parameter can be set: "
        echo "|  d) deletes unsused result sets"
        echo "|  h) show helping information "
        echo "************************************************"
        echo ""
        exit 0
        ;;
      "?")
        echo "Invalid option $OPTARG"
        exit 0
        ;;
      ":")
        echo "option $OPTARG requires an argument"
        exit 0
        ;;
      *)
      # Should not occur
        echo "Unknown error while processing options"
        exit 0
        ;;
    esac
  done

######################### Directory Cleaning
${BASEPATH}/bin/prepareOutputPath.sh $BASEPATH $OUTPUTDIR $DELETE_OLD_RUNS
if [[ $? -eq 5 ]]; then
    echo "Error in result path handling"
    echo "Quit without running metrics"
    exit 0;
fi

######################### Generate empty clover file in case it's not defined
if [[ ! -f $CLOVER_LOCATION ]] ; then
cat <<EOT > /tmp/empty_clover.xml
<?xml version="1.0" encoding="UTF-8"?>
<coverage generated="0">
  <project timestamp="0">
  </project>
</coverage>
EOT

CLOVER_LOCATION="/tmp/empty_clover.xml"
fi

######################### Run tests and oxmd for metrics
${BASEPATH}/bin/runTestsAndMetrics.sh $MODULEPATH $BASEPATH $OUTPUTDIR $CLOVER_LOCATION

######################### directory structure check
${BASEPATH}/bin/directory_structure.sh $MODULEPATH ${BASEPATH}$OUTPUTDIR

######################### prefix check
${BASEPATH}/bin/prefix.sh $MODULEPATH ${BASEPATH}$OUTPUTDIR $PREFIX

######################### file check
${BASEPATH}/bin/globals.sh $MODULEPATH ${BASEPATH}$OUTPUTDIR
${BASEPATH}/bin/method_length.sh $MODULEPATH ${BASEPATH}$OUTPUTDIR

######################### OUTPUT
php ${BASEPATH}/bin/showResult.php ${BASEPATH}$OUTPUTDIR $MODULEPATH

