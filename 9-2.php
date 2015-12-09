<?php

$str='Faerun to Norrath = 129
Faerun to Tristram = 58
Faerun to AlphaCentauri = 13
Faerun to Arbre = 24
Faerun to Snowdin = 60
Faerun to Tambi = 71
Faerun to Straylight = 67
Norrath to Tristram = 142
Norrath to AlphaCentauri = 15
Norrath to Arbre = 135
Norrath to Snowdin = 75
Norrath to Tambi = 82
Norrath to Straylight = 54
Tristram to AlphaCentauri = 118
Tristram to Arbre = 122
Tristram to Snowdin = 103
Tristram to Tambi = 49
Tristram to Straylight = 97
AlphaCentauri to Arbre = 116
AlphaCentauri to Snowdin = 12
AlphaCentauri to Tambi = 18
AlphaCentauri to Straylight = 91
Arbre to Snowdin = 129
Arbre to Tambi = 53
Arbre to Straylight = 40
Snowdin to Tambi = 15
Snowdin to Straylight = 99
Tambi to Straylight = 70';

$distances_array = explode("\n", $str);
$locations_array = array(); // Class Objects
$paths_array = array(); // distance key, path string val

Class Location {
  public $name;
  public $destinations = array();
  public $longest_path = array();

  function __construct($name) {
    $this->name = $name;
  }

  public function add_destination($destination, $distance) {
    global $locations_array;
    if(!isset($this->destinations[$destination])) { // Check if destination is already set
      $this->destinations[$destination] = $distance;

      // Create destination location if not already set
      if(!isset($locations_array[$destination])) {
        $locations_array[$destination] = new Location($destination);
      }

      // Add self destination to destination location
      $locations_array[$destination]->add_destination($this->name, $distance);
    } else {
      return false;
    }
  }

  public function get_distance_to($destination) {
    return $this->destinations[$destination];
  }
}

function pc_next_permutation($p, $size) {
    // slide down the array looking for where we're smaller than the next guy
    for ($i = $size - 1; $p[$i] >= $p[$i+1]; --$i) { }

    // if this doesn't occur, we've finished our permutations
    // the array is reversed: (1, 2, 3, 4) => (4, 3, 2, 1)
    if ($i == -1) { return false; }

    // slide down the array looking for a bigger number than what we found before
    for ($j = $size; $p[$j] <= $p[$i]; --$j) { }

    // swap them
    $tmp = $p[$i]; $p[$i] = $p[$j]; $p[$j] = $tmp;

    // now reverse the elements in between by swapping the ends
    for (++$i, $j = $size; $i < $j; ++$i, --$j) {
         $tmp = $p[$i]; $p[$i] = $p[$j]; $p[$j] = $tmp;
    }

    return $p;
}

foreach($distances_array as $distance) {
  preg_match('~(\S*) to (\S*) = (\d*)~', $distance, $matches);

  // Create location if not already set
  if(!isset($locations_array[$matches[1]])) {
    $locations_array[$matches[1]] = new Location($matches[1]);
  }

  // Add destination to location
  $locations_array[$matches[1]]->add_destination($matches[2], $matches[3]);
}

// Calculate permutations
$set = array_keys($locations_array);
$size = count($set) - 1;
$perm = range(0, $size);
$j = 0;

do {
  $distance = 0;
  foreach ($perm as $key => $i) {
    if($key+1 <= $size) {
      $distance += $locations_array[$set[$i]]->get_distance_to($set[$perm[$key+1]]);
    }
  }

  $perms[$j] = $distance;
} while ($perm = pc_next_permutation($perm, $size) and ++$j);

print max($perms);
