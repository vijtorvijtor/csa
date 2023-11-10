#!/bin/bash
dira=$(pwd)
sh=$dira"/sube.ftp"
echo -e "\nSintasys: ./subecsa.sh {patron de archivos incluyendo directorio, uso comun en /home/vertice/opt/*php }\n"
patron=$1
dirRemoto="public_html/$2"
echo "Parametros: patron:[$patron], dirRemoto:[$dirRemoto]"
echo patron: [$patron]
echo "#!/bin/bash" >$sh
echo "HOST='opticaeco.com'">>$sh
echo "US='u947744031.limpiezacsa.com'" >>$sh
echo "PA='CSA_ftp1'" >>$sh
#cd $dirw


echo "ftp  -i -p -v  -n  \$HOST <<EOF" >>$sh
echo "user \$US \$PA ">>$sh
echo "hash" >>$sh
echo "ascii" >>$sh
#echo "cd public_html">>$sh
echo "cd $2">>$sh
echo "pwd" >>$sh
ls $patron
for f in $(ls $patron);  do echo "put $f $(basename $f)">>$sh ; done
#for arc in "$@";  do echo "put $arc $arc">>$sh ; done
#for arc in $(ls -1 "$patron"); do echo "put $arc ">>$sh ; done
#echo 'busqueda: for arc in $(ls -1 '"$patron"'); do echo "put $arc ">>$sh ; done'
echo "quit" >>$sh
echo "EOF" >>$sh
chmod +x $sh
cd $dira
#echo "contenido de $sh:-----"
#cat $sh
#echo "--------"
#echo Ahora ejecutara el sh...
. /$sh
