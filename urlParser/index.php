<?php

require ('classes/Url.php');
require ('../dumpr.php');

$url = new Url;

?>

<p>The first url segment is: <strong><?=$url->getFirstElement()?></strong></p>
<p>The last url segment is: <strong><?=$url->getLastElement()?></strong></p>
<p>There are <strong><?=(count($url->urlArray))?></strong> url segments</p>

<ul>
    <li><a href="<?=$url->urlDomain.$url->urlRootPath?>">START</a></li> 
    <li><a href="<?=$url->urlDomain.$url->urlRootPath?>aaaaa/">aaaaa</a></li> 
    <li><a href="<?=$url->urlDomain.$url->urlRootPath?>bbbbb/">bbbbb</a></li> 
    <li><a href="<?=$url->urlDomain.$url->urlRootPath?>aaaaa/bbbbb">aaaaa/bbbbb</a></li> 
    <li><a href="<?=$url->urlDomain.$url->urlRootPath?>aaaaa/bbbbb/ccccc">aaaaa/bbbbb/ccccc</a></li> 
</ul>

<?php

dumpr($url);

?> 