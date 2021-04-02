<h2> API throttling system </h2>
<p> No third party library/framework used for the implementation. Controlling api traffic requests </p>
<h1>Api calls<h1>
<p>
<ul>
<li>
apiManage/router.php?action=listing
<p>Listing all the places</p>
</li>
<li>
apiManage/router.php?action=details&id=$id
<p>Show the details of each place</p>
</li>
</ul>

</p>
<h1>
Working flow
</h1>
<p>Configutration setted as duration(time period ,unit is in seconds) and limit(no of requests per duration).There is no ip wise checking to control, time and no of request based limits checking while calling api.</p>
<h1>
Traffic control functions
</h1>
<p>
<?php
$traffic = new Throttle();
$traffic::trafficControll($action); // request based checking traffic
?>
</p>
<h1>Configuration reset option</h1>
<p>Crednitals admin345/Admin@dfg
Urls to access admin url apiManage/admin
</p>
<h1>Working set up</h1>
<p>
Db available in data/db.sql
Corresponding settings update in classes/dbclass.php file.
</p>
