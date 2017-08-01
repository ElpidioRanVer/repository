<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Http\Request;

use App\Taxonomic_Classification;
use App\Dataset;
use App\Specie;
use App\Synonym;
use App\Ncbi_Record;
use App\External_Link;
use App\Vernacular_Name;

use App\Image;
use App\Sequence;

use App\Distribution;

use App\Specimen;

class TaxonomicClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taxonomic = Taxonomic_Classification::search($request->name)->orderBy('scientific_name','ASC')->paginate(10);
        $taxotable = Taxonomic_Classification::search($request->name)->orderBy('scientific_name', 'ASC')->get();
        return view('taxonomic.search')->with('taxonomic', $taxonomic)
        ->with('taxotable', $taxotable);
        #$specimens = Specimen::orderBy('id','ASC')->paginate(10);
        #return view('taxonomic.search')->with('specimens', $specimens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('taxonomic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $no_rows=$request->rows;
        $specimen_id=0;
        $dataset_id=0;
                
        //echo $no_rows;
        if ($no_rows) {

            //Save de new dataset.
            $dataset_data = new Dataset();
            $dataset_data->project_id=1;
            $dataset_data->save();

            global $dataset_id;
            $dataset_id = $dataset_data->id;
            echo "<b>".$dataset_id."</b><br>";

            echo("Total rows: ".$no_rows."<br>");
            dd($request->id);
            #dd($request->rank_marker140);
            #dd($request->record_name140);
            #dd($request->direct_links140);
            #dd($request->provider_name140);
            #dd($request->provider_abbr140);
            #dd($request->url140);
            #dd($request->subject140);
            #dd($request->category140);
            #dd($request->attribute140);
            #dd($request->vernacularName140);//null
            #dd($request->language140);//null
            #dd($request->taxonKey140);
            #dd($request->marine140);
            #dd($request->extinct140);
            #dd($request->source140);
            #dd($request->sourceTaxonKey140);

            #dd(DB::table('taxonomic_classifications')->where('id', $request->id[126])->first());

            for ($i=0; $i < $no_rows; $i++) {

                $exists = DB::table('taxonomic_classifications')->where('id', $request->id[$i])->first();

               /*if($i==139){
                    dd($exists);
                    continue; 
                }*/
                #echo("Faltan: ".($no_rows-$i)."<br>");

                $specimen_data = new Specimen();
                

                if(!$exists){
                    $tax_data = new Taxonomic_Classification();
                    
                     //global $specimen_data;    

                    //Required valueas
                    
                    $tax_data->scientific_name = $request->scientific_name[$i];
                    $tax_data->id = $request->id[$i];
                    $specimen_data->taxonomy_id=$tax_data->id;

                    $tax_data->specie=$request->input('specie.'.$i);
                    $subsp=$request->input('subspecie.'.$i);

                    if ($subsp!=""){
                        $tax_data->subspecie = $subsp;
                    }


                    //Optional values

                    if ($request->has('superkingdom'.$i)){
                        $field_name='superkingdom'.$i;
                        $tax_data->superkingdom = $request->$field_name;
                    }


                    if ($request->has('kingdom'.$i)){
                        $field_name='kingdom'.$i;
                        $tax_data->kingdom = $request->$field_name;
                    }
                    
                    if ($request->has('phylum'.$i)){
                        $field_name='phylum'.$i;
                        $tax_data->phylum = $request->$field_name;
                    }

                    if ($request->has('subphylum'.$i)){
                        $field_name='subphylum'.$i;
                        $tax_data->subphylum = $request->$field_name;
                    }


                    if ($request->has('superclass'.$i)){
                        $field_name='superclass'.$i;
                        $tax_data->superclass = $request->$field_name;
                    }

                    if ($request->has('class'.$i)){
                        $field_name='class'.$i;
                        $tax_data->class = $request->$field_name;
                    }

                    if ($request->has('subclass'.$i)){
                        $field_name='subclass'.$i;
                        $tax_data->subclass = $request->$field_name;
                    }

                    if ($request->has('infraclass'.$i)){
                        $field_name='infraclass'.$i;
                        $tax_data->infraclass = $request->$field_name;
                    }

                    if ($request->has('superorder'.$i)){
                        $field_name='superorder'.$i;
                        $tax_data->superorder = $request->$field_name;
                    }

                    if ($request->has('order'.$i)){
                        $field_name='order'.$i;
                        $tax_data->order = $request->$field_name;
                    }

                    if ($request->has('suborder'.$i)){
                        $field_name='suborder'.$i;
                        $tax_data->suborder = $request->$field_name;
                    }

                    if ($request->has('infraorder'.$i)){
                        $field_name='infraorder'.$i;
                        $tax_data->infraorder = $request->$field_name;
                    }

                    if ($request->has('parvorder'.$i)){
                        $y='parvorder'.$i;
                        $tax_data->parvorder = $request->$y;
                    }

                    if ($request->has('superfamily'.$i)){
                        $field_name='superfamily'.$i;
                        $tax_data->superfamily = $request->$field_name;
                    }

                    if ($request->has('family'.$i)){
                        $field_name='family'.$i;
                        $tax_data->family = $request->$field_name;

                        $specimen_data->family = $tax_data->family; 
                    }

                    if ($request->has('subfamily'.$i)){
                        $field_name='subfamily'.$i;
                        $tax_data->subfamily = $request->$field_name;
                    }

                    //The field "genus" is required
                    if ($request->has('tribe'.$i)){
                        $field_name='tribe'.$i;
                        $tax_data->tribe = $request->$field_name;
                    }//Rhaegar
                    else{
                        $tax_data->tribe = 'noneTribe';
                    }
                    //EndRhaegar

                    if ($request->has('genus'.$i)){
                        $field_name='genus'.$i;
                        $tax_data->genus = $request->$field_name;

                        $specimen_data->genus = $tax_data->genus;
                    }//Rhaegar
                    else{
                        $tax_data->genus = 'noneGenus';
                        $specimen_data->genus = $tax_data->genus;
                    }
                    //EndRhaegar

                    if ($request->has('subgenus'.$i)){
                        $field_name='subgenus'.$i;
                        $tax_data->subgenus = $request->$field_name;
                    }

                    
                    if ($request->has('rank_marker'.$i)){
                        $field_name='rank_marker'.$i;
                        $tax_data->rank_marker = $request->$field_name;
                    }

                    
                    echo $tax_data->id."<br>";
                    echo $tax_data->scientific_name."<br>";
                    echo "specie: ".$tax_data->specie."<br>";
                    echo "subspecie: ".$tax_data->subspecie."<br>";
                    echo "SPKD:".$tax_data->superkingdom."<br><br>";

                    $tax_data->save();


                    //Vernacular Names
                    if($request->has('vernacularName'.$i)){

                        $vn='vernacularName'.$i;
                        $lang='language'.$i;
                        $size=count($request->$vn);
                        for ($j=0; $j < $size; $j++) {
                            $vn_data = new Vernacular_Name();

                            $vn_data->name=$request->input($vn.'.'.$j);

                            if ($request->has($lang.'.'.$j)) {
                                $vn_data->language=$request->input($lang.'.'.$j);
                            }
                            

                            $vn_data->taxonomy_id=$tax_data->id;
                            $vn_data->save();
                            //echo $vn_data->name." - ".$vn_data->language."<br>";
                        }
                        echo  "<br><br>";
                    }
                   



                    //check and Get the values for "synonyms" table
                    if($request->has('synonym'.$i)){

                        $field_name='synonym'.$i;
                        $size=count($request->$field_name);

                        for ($j=0; $j < $size; $j++) {
                            $synonym_data = new Synonym();

                            $synonym_data->synonym=$request->input($field_name.'.'.$j);
                            $synonym_data->taxonomy_id=$tax_data->id;
                            $synonym_data->save();
                            //echo $synonym_data->synonym." - ";
                        }
                        echo  "<br><br><br>";
                    }


                    //check and Get the values for "ncbi_records" table
                    if($request->has('record_name'.$i) && $request->has('direct_links'.$i)){

                        $record='record_name'.$i;
                        $links='direct_links'.$i;
                        $size=count($request->$record);
                        for ($j=0; $j < $size; $j++) {
                            $ncbi_data = new Ncbi_Record();

                            $ncbi_data->record_name=$request->input($record.'.'.$j);
                            $ncbi_data->direct_links=$request->input($links.'.'.$j);

                            $ncbi_data->taxonomy_id=$tax_data->id;
                            $ncbi_data->save();
                            //echo $ncbi_data->record_name." - ".$ncbi_data->direct_links."<br>";
                        }
                        echo  "<br><br>";
                    }
                    
                    //check and Get the values for "external_links" table
                    if($request->has('provider_name'.$i)){

                        $povider='provider_name'.$i;
                        $abbr='provider_abbr'.$i;
                        $url='url'.$i;
                        $subject='subject'.$i;
                        $category='category'.$i;
                        $attr='attribute'.$i;
                        $size=count($request->$povider);
                        for ($j=0; $j < $size; $j++) {
                            $links_data = new External_Link();

                            $links_data->provider_name=$request->input($povider.'.'.$j);
                            $links_data->provider_abbr=$request->input($abbr.'.'.$j);
                            $links_data->url=$request->input($url.'.'.$j);
                            $links_data->subject=$request->input($subject.'.'.$j);
                            $links_data->category=$request->input($category.'.'.$j);
                            $links_data->attribute=$request->input($attr.'.'.$j);

                            $links_data->taxonomy_id=$tax_data->id;
                            $links_data->save();
                            //echo $links_data->provider_name." - ".$links_data->provider_abbr." - ".$links_data->url." - ".$links_data->subject." - ".$links_data->category." - ".$links_data->attr."<br>";
                        }
                        echo  "<br>";
                    }

                    

                    //Insert species table values
                    
                    if ($request->has('taxonKey'.$i)) {
                        
                        //$specie_info= new Specie();

                        $taxKey='taxonKey'.$i;
                        $marine='marine'.$i;
                        $terrestrial='terrestrial'.$i;
                        $extinct='extinct'.$i;
                        $hybrid='hybrid'.$i;
                        $livingPeriod='livingPeriod'.$i;
                        $ageInDays='ageInDays'.$i;
                        $sizeInMm='sizeInMm'.$i;
                        $massInGram='massInGram'.$i;
                        $habitat='habitat'.$i;
                        $freshwater='freshwater'.$i;

                
                        $size=count($request->$taxKey);
                        for ($j=0; $j < $size; $j++) {
                            $specie_info= new Specie();

                            if ($request->has($marine.'.'.$j)) {
                                $specie_info->marine = $request->input($marine.'.'.$j);
                                echo $specie_info->marine."<br>";
                            }

                            if ($request->has($terrestrial.'.'.$j)) {
                                $specie_info->terrestrial = $request->input($terrestrial.'.'.$j);
                                echo "Terrestrial: ".$specie_info->terrestrial."<br>";
                            }

                            if ($request->has($extinct.'.'.$j)) {
                                $specie_info->extinct = $request->input($extinct.'.'.$j);
                                echo "Extinct: ".$specie_info->extinct."<br>";
                            }

                            if ($request->has($hybrid.'.'.$j)) {
                                $specie_info->hybrid = $request->input($hybrid.'.'.$j);
                                echo "Hybrid: ".$specie_info->hybrid."<br>";
                            }

                            if ($request->has($livingPeriod.'.'.$j)) {
                                $specie_info->living_period = $request->input($livingPeriod.'.'.$j);
                                echo "livingPeriod: ".$specie_info->living_period."<br>";
                            }

                            if ($request->has($ageInDays.'.'.$j)) {
                                $specie_info->age_in_days = $request->input($ageInDays.'.'.$j);
                                echo "ageInDays: ".$specie_info->age_in_days."<br>";
                            }

                            if ($request->has($sizeInMm.'.'.$j)) {
                                $specie_info->size_in_mm = $request->input($sizeInMm.'.'.$j);
                                echo "sizeInMm: ".$specie_info->size_in_mm."<br>";
                            }

                            if ($request->has($massInGram.'.'.$j)) {
                                $specie_info->mass_in_gram = $request->input($massInGram.'.'.$j);
                                echo "massInGram: ".$specie_info->mass_in_gram."<br>";
                            }

                            if ($request->has($habitat.'.'.$j)) {
                                $specie_info->habitat = $request->input($habitat.'.'.$j);
                                echo "habitat: ".$specie_info->habitat."<br>";
                            }

                            if ($request->has($freshwater.'.'.$j)) {
                                $specie_info->freshwater = $request->input($freshwater.'.'.$j);
                                echo "freshwater: ".$specie_info->freshwater."<br>";
                            }


                            
                            
                            $specie_info->taxonomy_id=$tax_data->id;
                            echo "<b>".$specie_info->taxonomy_id."</b>";
                            
                            
                            $specie_info->save();
                            //echo $links_data->provider_name." - ".$links_data->provider_abbr." - ".$links_data->url." - ".$links_data->subject." - ".$links_data->category." - ".$links_data->attr."<br>";
                        }
                     }    
                
                }
                else{
                    echo "Ya existe la información taxonomica del elemento ".$i."<br>";
                    #continue;
                }

                //Insert specimen values
                global $dataset_id;

                $specimen_data->media_id=1;
                $specimen_data->literature_id=1;
                $specimen_data->metadata_id=1;
                $specimen_data->identifier_id=1;
                $specimen_data->collection_id=1;
                $specimen_data->user_id=1;
                $specimen_data->dataset_id=$dataset_id;//not null

                $specimen_data->taxonomy_id = $request->id[$i];//not null

                if ($request->has('family'.$i)){
                    $field_name='family'.$i;
                    $specimen_data->family = $request->$field_name;
                }//Rhaegar
                else{
                    $field_name='family'.$i;
                    $specimen_data->family = 'noneFamily';
                }
                //EndRhaegar

                if ($request->has('genus'.$i)){
                    $field_name='genus'.$i;
                    $specimen_data->genus = $request->$field_name;
                }//Rhaegar
                else{
                    $field_name='genus'.$i;
                    $specimen_data->genus = 'noneGenus';
                }
                //EndRhaegar


                $specimen_data->save();

                global $specimen_id;
                $specimen_id=$specimen_data->id;


                //Distribution Info;
                if ($request->has('latitude'.$i) && $request->has('longitude'.$i)){
                    global $specimen_id;

                    $lat='latitude'.$i;
                    $lon='longitude'.$i;
                    $country='country'.$i;
                    $region='administrative_area_level_1'.$i;

                    $dist_info = new Distribution();

                    //$dist_info->specimen_id=1;
                    $dist_info->specimen_id = $specimen_id;

                    $dist_info->latitude = $request->$lat;
                    $dist_info->longitude = $request->$lon;
                    $dist_info->country = $request->$country;
                    $dist_info->region = $request->$region;

                    //echo "<b>".$dist_info->latitude.": ".$dist_info->longitude.": ".$dist_info->country.": ".$dist_info->region.": ";

                    if ($request->has('locality'.$i)) {
                        $locality='locality'.$i;
                        $dist_info->locality = $request->$locality;
                        //echo $dist_info->locality.":";
                    }

                    if ($request->has('political'.$i)) {
                        $sublocality='political'.$i;
                        $dist_info->sub_locality = $request->$sublocality;
                        //echo $dist_info->sub_locality;
                    }

                    $dist_info->save();
                    echo "</b><br>";
                }//Rhaegar
                else{
                    global $specimen_id;
                    $dist_info = new Distribution();
                    $dist_info->specimen_id = $specimen_id;

                    $dist_info->latitude = 0.0;
                    $dist_info->longitude = 0.0;
                    $dist_info->country = 'noneCountry';
                    $dist_info->region = 'noneRegion';
                    
                    if ($request->has('locality'.$i)) {
                        $locality='locality'.$i;
                        $dist_info->locality = $request->$locality;
                        //echo $dist_info->locality.":";
                    }else{
                        $dist_info->locality = 'noneLocality';
                    }

                    if ($request->has('political'.$i)) {
                        $sublocality='political'.$i;
                        $dist_info->sub_locality = $request->$sublocality;
                        //echo $dist_info->sub_locality;
                    }else{
                        $dist_info->sub_locality = 'noneSubLocality';
                    }
                    $dist_info->save();
                }
                //EndRhaegar

                //Images
                if($request->has('myFiles'.$i)){

                    $imgFile='myFiles'.$i;
                    global $specimen_id;
                        
                    $size=count($request->$imgFile);
                    for ($j=0; $j < $size; $j++) {
                        $images = new Image();

                        $images->specimen_id=$specimen_id;
                        $images->name=$request->input($imgFile.'.'.$j);
                        $images->save();
                        echo "<b>".$images->name."</b>";

                    }
                    echo  "<br><br>";
                }

                    //Image Folder
                if($request->has('fileDir'.$i)){

                    $imgFile='fileDir'.$i;
                    global $specimen_id;
                        
                    $size=count($request->$imgFile);
                    for ($j=0; $j < $size; $j++) {
                        $images = new Image();

                        $images->specimen_id=$specimen_id;
                        $images->name=$request->input($imgFile.'.'.$j);
                        $images->save();
                        echo "<b>".$images->name."</b>";
                    }
                    echo  "<br><br>";
                }

                //Sequence files
                if($request->has('seqFiles'.$i)){

                    $imgFile='seqFiles'.$i;
                    global $specimen_id;
                        
                    $size=count($request->$imgFile);
                    for ($j=0; $j < $size; $j++) {
                        $seq_files = new Sequence();

                        $seq_files->specimen_id=$specimen_id;
                        $seq_files->path=$request->input($imgFile.'.'.$j);
                        $seq_files->save();
                        
                        //echo "<b>".$seq_files->path."</b>";
                    }//EndFor
                    echo  "<br><br>";
                }//EndIf
            }//EndFor 
        }//EndIf
    }//EndFunctionStore

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //made by Rhaegar

    //endmade by Rhaegar
}
