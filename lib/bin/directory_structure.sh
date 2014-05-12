#!/usr/bin/env bash

#functions
in_array() {
    local haystack=${1}[@]
    local needle=${2}
    for i in ${!haystack}; do
        if [[ ${i} == ${needle} ]]; then
            return 0
        fi
    done
    return 1
}

# init declaration
declare modulepath
declare outputpath
declare -a moduledirs
declare -a alloweddirs
alloweddirs=(controllers components core documentation install models out tests translations views)
#admins log settings   config  lib  xml  controller  licenses

modulepath=$1
outputpath=$2

# logfile creation
logfile=$outputpath"directory.log"
if [ -f $logfile ]
then
rm $logfile
fi
touch $logfile

echo ${alloweddirs[@]}

moduledirs=`ls -l --time-style="long-iso" $modulepath | egrep '^d' | awk '{print $8}'`

echo ""
echo "#########checkfoldername#############"
echo ""
for f in $moduledirs
do
    in_array alloweddirs ${f} && echo ${f}" found" || echo "Directory "${f}" is not allowed"  >> $logfile
    echo ${f}
done


echo ""
echo "########gothroughfiles##############"
echo ""

echo ""
echo "#########checkmetadata#############"
echo ""
