METACAT_CLASSES=$METACAT_HOME/classes
METACAT_LIB=$METACAT_HOME/lib
for JAR in $METACAT_LIB/*.jar; do
    [ -f "$JAR" ] || continue
	LIB_JARS="$LIB_JARS:$JAR"
done
export CLASSPATH=$METACAT_CLASSES:$LIB_JARS
cd $METACAT_CLASSES
java edu.ucsb.nceas.metacat.oaipmh.harvester.OaipmhHarvester $*
