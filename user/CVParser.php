<?php

declare(strict_types=1);

namespace Phpml\Classification;

use Phpml\Helper\Predictable;
use Phpml\Helper\Trainable;
use Phpml\Math\Distance;
use Phpml\Math\Distance\Euclidean;

inlcude_once 'KNearestNeighbors'
inlcude_once 'tokenizer.class.php';
include 'db.php'

class CVParser 
{

function()
db=fetch(Users)  
$CV = fopen(file +.doc, "r") or die("Unable to open file!");
echo fread($myfile,filesize(file +.doc));
fclose($C);

$tokens = new tokenizer();
tokens->tokenize($CV);
features= CountVectorizer($CV);
Exractors= new KNearestNeighbors(features);


}
?>