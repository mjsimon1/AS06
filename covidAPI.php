<?php 
main();
function main () {
	
	$apiCall = 'https://api.covid19api.com/summary';
	// line below stopped working on CSIS server
	// $json_string = file_get_contents($apiCall); 
	$json_string = curl_get_contents($apiCall);
	$obj = json_decode($json_string);
	$data = $obj->Countries;
	
    usort($data, 'comparator');
    
    $i;
    
   
	// echo html head section
	echo '<html>';
	echo '<head>';

    echo '<meta charset="utf-8">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">';
echo '</head>';
echo '<body>';  
  echo '<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">';
  
 echo '</script>';
  echo '<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">';
  
  
 echo '</script>';
 echo  '<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">';
 
 echo '</script>';

echo '</head>';
	

	echo '<body>';
	
	
	echo '
	<div class="container">
	<div class="row">
                <h3>Covid-19 Cases</h3>
    </div>
	<div class="row">
	<table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Country</th>
                <th>Number of cases</th>
            </tr>
        </thead>
        <tbody>';
        
    $i = 0;
        
    foreach($data as $row){
        
        echo '<tr>';
        echo '<td>'. $row->Country . '</td>';
        echo '<td>'. $row->TotalConfirmed . '</td>';
        echo '</tr>';
        
        $i++;
        if($i == 10){
            break;
        }
    }
        
    echo '</tbody>
    </table>
    </div>
    </div>';

	// close html body section
	echo '</body>';
	echo '</html>';
}

function comparator($object1, $object2) { 
    return $object1->TotalConfirmed < $object2->TotalConfirmed; 
} 

// read in from a URL
function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
?>