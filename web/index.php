<?php
require_once("../app/kernel.php");


 $validator = new validator();
 
 echo($validator->checkMail("cyrteix@aol.com"));
 echo($validator->checkIp("192.168.1.1"));
 echo($validator->checkInt(18));
 echo($validator->checkStringExp("Maman", "/^M(.*)/"));
 echo($validator->checkUrl("httpsdsqdfgqsd://wwwqfg.yosdqfgutube.sdfqsdfqsdfqsdfqsdffr"));
 
 //echo($validator->cleanMail("cyrteix@aol.com"));
 //echo($validator->cleanUrl("htt//...d://wwwqfg.yosdqf5412gutube.sdfqsdfqsdfqsdfqsdffr"));
