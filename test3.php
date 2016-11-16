<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $key = 'AIzaSyDv0SJXrfeWAu-LeH9z_1XXriQC-Lrdilk';
        $address = "DD14LH";
        $branchAddress = "DD13HB";
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=". $address .",+&key=".$key;
        $jsonData   = file_get_contents($url);
        $data = json_decode($jsonData);
        //$data = json_decode($jsonData);

        $xlatAddress = $data->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $xlongAddress = $data->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        
        echo $xlatAddress.",".$xlongAddress;
        echo "<br>";
        
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=". $branchAddress .",+&key=".$key;
        $jsonData   = file_get_contents($url);
        $data = json_decode($jsonData);
        //$data = json_decode($jsonData);

        $xlatBranch = $data->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $xlongBranch = $data->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        
        echo $xlatBranch.",".$xlongBranch;
        
        //echo $json['results'][0]['geometry'];

        
        function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
        echo "<br><br>";
        echo distance($xlatAddress,$xlongAddress,$xlatBranch,$xlongBranch, "M"). " Miles<br>";
        echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
        echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";
        echo distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";
        ?>
    </body>
</html>
