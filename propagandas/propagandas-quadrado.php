<?php
$banner['1'] = "
<a href=\"http://www.youtube.com\" target=\"_blank\">
<img src=\"../midias/banner.png\" />
</a>
";

$banner['2'] = "
<a href=\"http://www.baixaki.com.br\" target=\"_blank\">
<img src=\"../midias/banner.gif\" />
</a>
";

$rand = rand(1,2);

print $banner[$rand];

?>