
#!/bin/bash
args=("$@")

function goto
{
label=$1
cmd=$(sed -n "/$label:/{:a;n;p;ba};" $0 | grep -v ':$')
eval "$cmd"
exit
}

#@echo off
java ${args[0]}.java < ${args[1]}/1.in > ${args[2]}.sol & sleep 2 ; kill $!
java ${args[0]}.java < ${args[1]}/2.in >> ${args[2]}.sol & sleep 2 ; kill $!
java ${args[0]}.java < ${args[1]}/3.in >> ${args[2]}.sol & sleep 2 ; kill $!

trap finish EXIT
exit 