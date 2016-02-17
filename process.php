<?php
   function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
   $myFile = "entries.json";
   $arr_data = array(); // create empty array

  try
  {
	  debug_to_console( "test" );
	$arrCat=[];
	$arrRef=[];
	if($_POST['categories']!="")
	$arrCat=explode(",",$_POST['categories']);
	if($_POST['references']!="")
	$arrRef=explode(",",$_POST['references']);

	$entryId=intval($_POST['entryId']);
	   //Get data from existing json file
	   $jsondata = file_get_contents($myFile);
 
	   
	   // converts json data into array
	   $arr_data = json_decode($jsondata, true);
	   //if id exists in file overwrite it

	      //Get form data
	   $formdata = array(
	      'id'=> $entryId,
	      'title'=> $_POST['title'],
	      'description'=>$_POST['description'],
	      'categories'=> $arrCat,
		  'references'=> $arrRef
	   );

 if($entryId<count($arr_data) ){
	$arr_data[$entryId-1]=$formdata;
 }else{
	 // Push user data to array
	   array_push($arr_data,$formdata); 
 }

	  

       //Convert updated array to JSON
	 		  $jsondata = json_encode($arr_data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
	  
	   //write json data into data.json file
	   if(file_put_contents($myFile, $jsondata)) {
	        echo 'Data successfully saved';
	    }
	   else 
	        echo "error";

   }
   catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
   }

?>