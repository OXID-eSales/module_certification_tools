#!/bin/bash

# $1 -> coverage-datei /htdocs/efire/coverage3.xml
# $2 -> ausgabe-datei /htdocs/efire/report3.xml
# $3 -> verzeichnis, welches gecheckt wierden soll /htdocs/efire/oxid-phpmd/src/main/
# $4 -> opt. test(-verzeichnis) unit/core/service/fromServer/model/result/Unit_oeplShopLanguagesTest.php


# init declaration
declare modulepath
declare delete
declare -a moduledirs
declare basepath

# getting path information
pushd . > /dev/null
basepath="${BASH_SOURCE[0]}";
if ([ -h "${basepath}" ]) then
  while([ -h "${basepath}" ]) do cd `dirname "$SCRIPT_PATH"`; SCRIPT_PATH=`readlink "${basepath}"`; done
fi
cd `dirname ${basepath}` > /dev/null
basepath=`pwd`;
popd  > /dev/null


# loading config file
if [ ! -f "$basepath""/config.cfg" ]; then
  echo " ! ERROR: config file is not found, stops executing"
  exit
fi
. "$basepath""/config.cfg"

#var setting



# options
while getopts ":dh" opt
  do
    case "$opt" in
      "d")
        delete=true
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

#########################


#########################

# phpunit  --coverage-clover $1 $4

# /htdocs/efire/oxid-phpmd/src/bin/oxmd $3 $1 --reportfile-xml $2


#########################

# ./folder_check.sh


######################### OUTPUT

# no output yet

# ./runModuleCertification.sh /htdocs/efire/coverage4.xml /htdocs/efire/report4.xml /htdocs/efire/testshops/EE_5_0_5/modules/oe/oepl/model/
