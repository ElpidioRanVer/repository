#!/bin/sh
cd /path/to/ARK/template/fk1/

noid mint 1 > output.txt

arkid=`grep id: output.txt`
ark="${arkid#*id: }"

echo $ark

> fileDetails.txt

> response.txt


    curl -X POST --cookie-jar sessionid.txt --form cfg=metacatui --form "stage=login" --form username="uid=user,o=unaffiliated,dc=ecoinformatics,dc=org" --form organization=unaffiliated --form password=pass  "http://X.X.X.X:80/metacat/cgi-bin/register-dataset.cgi" -o response.txt




    curl -X POST --cookie sessionid.txt --form file_0=@test11.xml --form cfg=metacatui --form "metaid=$ark" --form stage=insert --form providerGivenName=Alfonso --form providerSurName=Calderon --form partyFirstName=Ulises --form partyLastName=Olivares --form partyRole=creator --form "title=Curl ark V1" --form site=LANASE --form origNamefirst0=Ulises --form origNamelast0=Olivares --form abstract=test --form beginningYear=2015 --form geogdesc=Mex --form latDeg1=0 --form longDeg1=0 --form dataMedium=digital --form "useConstraints=no restrictions" --form useOrigAddress=on --form scope=test --form fileCount=1 "http://X.X.X.X:80/metacat/cgi-bin/register-dataset.cgi" -o response.txt

    counter=$[$counter+1]



    getupload=`grep upload_0 response.txt`
    upload="${getupload#*value=\"}"
    upload="${upload%%\"*}"
    #upload=""

    getuploadname=`grep uploadname_0 response.txt`
    uploadname="${getuploadname#*value=\"}"
    uploadname="${uploadname%%\"*}"
    #uploadname=""

    getuploadtype=`grep uploadtype_0 response.txt`
    uploadtype="${getuploadtype#*value=\"}"
    uploadtype="${uploadtype%%\"*}"
    #uploadtype=""

    #echo "$upload,$uploadname,$uploadtype," >> fileDetails.txt
    #echo "$upload, $uploadname ,$uploadtype"


    curl -X POST -v --cookie sessionid.txt --form file_0=@test11.xml --form cfg=metacatui  --form "metaid=$ark" --form stage=confirmed --form providerGivenName=Alfonso --form providerSurName=Calderon --form "title=Curl ark V1" --form site=LANASE --form partyFirstName=Ulises --form partyLastName=Olivares --form partyRole=creator --form partyFirstName0=Ulises --form partyLastName0=Olivares --form partyRole0=creator --form origNamefirst0=Ulises --form origNamelast0=Olivares --form abstract=test --form beginningYear=2015 --form geogdesc=Mex --form latDeg1=0 --form longDeg1=0 --form dataMedium=digital --form "useConstraints=no restrictions" --form useOrigAddress=on  --form fileCount=1 --form upCount=1 --form delCount=1 --form uploadperm_0=public --form "upload_0=$upload" --form "uploadname_0=$uploadname" --form "uploadtype_0=$uploadtype" "http://X.X.X.X:80/metacat/cgi-bin/register-dataset.cgi" -o salida.txt & 
