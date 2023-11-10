#!/bin/bash
Nombre="opticaeco"$(date +"%Y%m%d_%H%M").sql
Lg="ActualizaOptica.log"
echo $Nombre >>$Lg
serv="sql484.main-hosting.eu"
user="u947744031_optica"
pass="1Abejash(*@"
base="u947744031_optica"
echo "Descargardo de servidor [$user : $pass : $base @ $serv]... "
mysqldump --no-tablespaces  -h $serv  -u"$user" -p"$pass" $base > $Nombre
tam=$(stat -f%z $Nombre)
if [[ $tam -gt 0 ]]; then
		echo "Se actualiza la base con [$Nombre], porque tam=[$tam] ">>$Lg
		mysql --user=$user --password="$pass" --execute "DROP DATABASE $base;"
		mysql -u $user --password="$pass" --execute "CREATE DATABASE $base;"
		mysql -v -v -v -u $user  --password="$pass" --default_character_set utf8 $base  < $Nombre
else
		echo "*** FALLO *** respaldo [$Nombre], tam=[$tam] *** FALLO ***">>$Lg
		ls -l $Nombre >> $Lg
fi
