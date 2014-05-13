#!/bin/bash

# init declaration
declare MODULEPATH
declare DELETE_OLD_RUNS
declare BASEPATH
declare OUTPUTDIR
declare CLOVER_LOCATION

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
if [ ! -f "$BASEPATH""/config.cfg" ]; then
  echo " ! ERROR: config file is not found, stops executing"
  exit
fi
. "$BASEPATH""/config.cfg"



############insert here functionality to determine the path of output directory
DATE=$(/bin/date +%Y%m%d%H%M%S)
OUTPUTDIR=/output/${DATE}



#var settings
MODULEPATH=$CFG_MODULEPATH


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
        echo "|  h) shows helping information (this fancy peace of shit)"
        echo "************************************************"
        echo ""
        ;;
      "?")
        echo "Invalid option $OPTARG"
        ;;
      ":")
        echo "option $OPTARG requires an argument"
        ;;
      *)
      # Should not occur
        echo "Unknown error while processing options"
        ;;
    esac
  done

######################### Directory Cleaning
${BASEPATH}/lib/bin/prepareOutputPath.sh $BASEPATH $OUTPUTDIR $DELETE_OLD_RUNS

######################### Run tests and oxmd for metrics
${BASEPATH}/lib/bin/runTestsAndMetrics.sh $MODULEPATH $BASEPATH $OUTPUTDIR $CLOVER_LOCATION

######################### directory structure check
${BASEPATH}/lib/bin/directory_structure.sh $MODULEPATH ${BASEPATH}/$OUTPUTDIR

######################### prefix check
${BASEPATH}/lib/bin/prefix.sh $MODULEPATH ${BASEPATH}/$OUTPUTDIR

######################### file check
${BASEPATH}/lib/bin/globals.sh $MODULEPATH ${BASEPATH}/$OUTPUTDIR

######################### OUTPUT

# no output yet

