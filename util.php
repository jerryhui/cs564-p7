<?php
/**
 * US STATE DROPDOWN LIST
 * ROGER E THOMAS December 2010
 * http://www.rogerethomas.com
 * Completely free to download and use in your scripts.
 * Call as: echo listUSStates($state_values,$dropdown_name,$key_selected);
 *
 * $dropdown_name is the name of the final select box.
 * $key_selected is the value of the index that should be selected by default
 *              This should come in handy when dealing with incorrect address
 *              information and promting the user for more info.
 *
 *
 */

$state_values=array(
                ' '=>"- none -",
                'AL'=>"Alabama",
                'AK'=>"Alaska",
                'AZ'=>"Arizona",
                'AR'=>"Arkansas",
                'CA'=>"California",
                'CO'=>"Colorado",
                'CT'=>"Connecticut",
                'DE'=>"Delaware",
                'DC'=>"District Of Columbia",
                'FL'=>"Florida",
                'GA'=>"Georgia",
                'HI'=>"Hawaii",
                'ID'=>"Idaho",
                'IL'=>"Illinois",
                'IN'=>"Indiana",
                'IA'=>"Iowa",
                'KS'=>"Kansas",
                'KY'=>"Kentucky",
                'LA'=>"Louisiana",
                'ME'=>"Maine",
                'MD'=>"Maryland",
                'MA'=>"Massachusetts",
                'MI'=>"Michigan",
                'MN'=>"Minnesota",
                'MS'=>"Mississippi",
                'MO'=>"Missouri",
                'MT'=>"Montana",
                'NE'=>"Nebraska",
                'NV'=>"Nevada",
                'NH'=>"New Hampshire",
                'NJ'=>"New Jersey",
                'NM'=>"New Mexico",
                'NY'=>"New York",
                'NC'=>"North Carolina",
                'ND'=>"North Dakota",
                'OH'=>"Ohio",
                'OK'=>"Oklahoma",
                'OR'=>"Oregon",
                'PA'=>"Pennsylvania",
                'RI'=>"Rhode Island",
                'SC'=>"South Carolina",
                'SD'=>"South Dakota",
                'TN'=>"Tennessee",
                'TX'=>"Texas",
                'UT'=>"Utah",
                'VT'=>"Vermont",
                'VA'=>"Virginia",
                'WA'=>"Washington",
                'WV'=>"West Virginia",
                'WI'=>"Wisconsin",
                'WY'=>"Wyoming"
    );
function listUSStates($state_values,$dropdown_name,$key_selected) {

    $string="<select name=\"".$dropdown_name."\">\n";
    if (!empty($state_values)) {
        if ($key_selected=="" || !isset($key_selected)) {
            $string.="<option value=\"\">Please select</option>\n";
        }
        foreach($state_values as $state_short=>$state_full) {
            if ($key_selected!="" && $key_selected==$state_short) {
                $additional=" SELECTED";
            }
            else {
                $additional="";
            }
                $string.="<option value=\"".$state_short."\"".$additional.">".$state_full."</option>\n";
        }
    }
    $string.="</select>\n";
    return $string;
}
?>