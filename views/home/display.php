<link rel="stylesheet" href="<?php echo STATIC_URL; ?>js/calendar/css/eventCalendar.css">
<link rel="stylesheet" href="<?php echo STATIC_URL; ?>js/calendar/css/paragridma.css">
<link rel="stylesheet" href="<?php echo STATIC_URL; ?>js/calendar/css/eventCalendar_theme_responsive.css">
<script src="js/calendar/js/jquery.eventCalendar.js" type="text/javascript"></script>
<script src="js/hover.js" type="text/javascript"></script>


<div class="rowHolder">
    <h2 style="margin: 10px 0px;">
        Note Worthy Content
    </h2>
    <div class="topRow">
        <div class="calendar">
            <div id="eventCalendarInline"></div>
                <?php $music = $this->query('SELECT * FROM contents as v WHERE v.type="calendar" ORDER BY v.data'); 
                    $jsonCalendar = '[';
                    foreach($music as $m){
                        $data = json_decode($m['data']);
                        $jsonCalendar .= '{"date":"'.strtotime($data->date).'000", "type":"event", "title":"'.$m['name'].'", "description":"at '.$data->placeName.' in '.$data->city.'","url":"?page=user/showEvent/'.$m['content_id'].'"},';
                    }
                ?>
                <script>
                    $(document).ready(function() {
                        var eventsInline = <?php echo substr($jsonCalendar, 0, -1); ?>];

                        $("#eventCalendarInline").eventCalendar({
                            jsonData: eventsInline
                        });
                    });
                </script>
            <div class="music">Top Music Events</div>
            <div id="music" style="height: 0px; overflow: hidden;">
                <?php $music = $this->query('SELECT * FROM contents as v WHERE v.type="calendar" AND v.data LIKE "%\"type\":\"Music\"%" ORDER BY v.data LIMIT 0,10'); 
                foreach($music as $m){ $data = json_decode($m['data']); ?>
                <div class="calendarEvent">
                    <div><?php echo date('Y-m-d h:i:s', strtotime($data->date)); ?></div>
                    <a href="?page=user/showEvent/<?php echo $m['content_id']; ?>"><?php echo $m['name']; ?></a> - at the <?php echo $data->placeName; ?> in <?php echo $data->city; ?>
                </div>
                <?php } ?>
            </div>
            <div class="event">Top Art Events</div>
            <div id="event" style="height: 0px; overflow: hidden;">
                <?php $music = $this->query('SELECT * FROM contents as v WHERE v.type="calendar" AND v.data LIKE "%\"type\":\"Art\"%" ORDER BY v.data LIMIT 0,10'); 
                foreach($music as $m){ $data = json_decode($m['data']); ?>
                <div class="calendarEvent">
                    <div><?php echo date('Y-m-d', strtotime($data->date)); ?></div>
                    <a href="?page=user/showEvent/<?php echo $m['content_id']; ?>"><?php echo $m['name']; ?></a> - at the <?php echo $data->placeName; ?> in <?php echo $data->city; ?>
                </div>
                <?php } ?>
            </div>
            <div class="fashion">Top Fashion Events</div>
            <div id="fashion" style="height: 0px; overflow: hidden;">
                <?php $music = $this->query('SELECT * FROM contents as v WHERE v.type="calendar" AND v.data LIKE "%\"type\":\"Fashion\"%" ORDER BY v.data LIMIT 0,10'); 
                foreach($music as $m){ $data = json_decode($m['data']); ?>
                <div class="calendarEvent">
                    <div><?php echo date('Y-m-d', strtotime($data->date)); ?></div>
                    <a href="?page=user/showEvent/<?php echo $m['content_id']; ?>"><?php echo $m['name']; ?></a> - at the <?php echo $data->placeName; ?> in <?php echo $data->city; ?>
                </div>
                <?php } ?>
            </div>
            <div class="movie">Top Movie Events</div>
            <div id="movie" style="height: 0px; overflow: hidden;">
                <?php $music = $this->query('SELECT * FROM contents as v WHERE v.type="calendar" AND v.data LIKE "%\"type\":\"Movie\"%" ORDER BY v.data LIMIT 0,10'); 
                foreach($music as $m){ $data = json_decode($m['data']); ?>
                <div class="calendarEvent">
                    <div><?php echo date('Y-m-d', strtotime($data->date)); ?></div>
                    <a href="?page=user/showEvent/<?php echo $m['content_id']; ?>"><?php echo $m['name']; ?></a> - at the <?php echo $data->placeName; ?> in <?php echo $data->city; ?>
                </div>
                <?php } ?>
            </div>
            <div class="award">Top Award Events</div>
            <div id="award" style="height: 0px; overflow: hidden;">
                <?php $jsonCalendar = '['; ?>
                <?php $music = $this->query('SELECT * FROM contents as v WHERE v.type="calendar" AND v.data LIKE "%\"type\":\"Award\"%" ORDER BY v.data LIMIT 0,10');
                foreach($music as $m){ $data = json_decode($m['data']); ?>
                <div class="calendarEvent">
                    <div class="calendar"></div>
                    <div><?php echo date('Y-m-d', strtotime($data->date)); ?></div>
                    <a href="?page=user/showEvent/<?php echo $m['content_id']; ?>"><?php echo $m['name']; ?></a> - at the <?php echo $data->placeName; ?> in <?php echo $data->city; ?>
                </div>
                <?php $jsonCalendar .= '{"date":"'.strtotime($data->date).'", "type":"event", "title":"'.$m['name'].'", "?page=user/showEvent/'.$m['content_id'].'"},'?>
                <?php } ?>
                <script>
                    $(document).ready(function() {
                        $("#award calendar").eventCalendar({
                            jsonData: <?php echo $jsonCalendar.']'; ?> // link to events json
                        });
                    });
                </script>
            </div>
            <h2><?php echo date('F d', strtotime(date('Y-m-d'))-(60*60*24*6)).' - '.date('F d, Y', strtotime(date('Y-m-d'))); ?></h2>
        </div>
        <div class="featured">
            <?php foreach($this->info['content']['images'] as $key=>$c){ ?>
            <div class="featuredContentHolder" id="contentHolder<?php echo $key; ?>" style="background: #000; height: 300px;">
                <a href="?page=user/content/show/<?php echo $c['content_id']; ?>">
                    <div class="imageArea" style="height: 300px; overflow: hidden;"><?php echo $this->getContent($c['content_id']); ?></div>
                    <canvas class="area" width="600" height="300"></canvas>
                    <div class="title"><?php echo $c['name']; ?></div>
                    <div class="description"><?php echo substr($c['description'], 0, 100).'...'; ?></div>
                    <div style="color: #6e6e6e; text-align: right; margin-top: 10px;"><?php echo date('Y-m-d', strtotime($c['created'])); ?></div>
                    <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $c['user_id']){ ?>
                    <div><a href="?page=user/deleteContent/<?php echo $c['content_id']; ?>">Delete</a></div>
                    <?php } ?>
                </a>
            </div>
            <?php } ?>
    <img id="canvasSource" src="http://192.168.56.101/twitters/uploads/usersDir/3/65.jpeg" alt="Canvas Source" style="display: none;"/>

    <canvas id="area" width="500" height="300"></canvas>
    <script>
        window.onload = function() {
            var currLayout = 0;
            $('.topRow .featuredContentHolder').each(function(){
                if(currLayout != 2){
                    $(this).css('display', 'none');
                }
                ++currLayout;
            });
            
            currLayout = 2;
            var timeout = setTimeout(changeLayout, 5000);
            
            function changeLayout(){
                timeout = clearTimeout();
                
                var next = currLayout+1;
                if(next > 2){
                    next = 0;
                }
                
                $('#contentHolder'+next).css('display', 'block'); 
                $('#contentHolder'+currLayout).animate({'opacity':0}, 1000, function(){
                    $(this).css('display', 'none'); 
                });
                $('#contentHolder'+next).animate({'opacity':1}, 1000);
                
                currLayout = next;
                timeout = setTimeout(changeLayout, 5000);
            }
            
            $.fn.expand = function(){
                $('.'+$(this).attr('class')).click(function(){
                    var parent = $('#'+$(this).attr('class'));
                    if(parent.height() == '0'){
                        parent.css('height', '200px');
                    } else {
                        parent.css('height', '0px');
                    }
                    return false;
                })
            }
            
            $('.music').expand();
            $('.event').expand();
            $('.movie').expand();
            $('.award').expand();
            $('.fashion').expand();
        };
    </script>
    <div style="padding: 10px; font-size: 15px;">Welcome to The spot, where "creativity isn't seen as useless" industry.</div>
    <div id="latestPosts">
        <h2 style="margin-bottom: 10px;">Latest Postings</h2>
        <?php $search = $this->query('SELECT c.*, SUM(i.count) AS count FROM contents AS c JOIN impressions AS i ON i.type_id=c.content_id WHERE c.type="article" AND i.type="content" GROUP BY c.content_id ORDER BY i.count, c.created DESC LIMIT 0,10');
            foreach($search as $s){
        ?>
        <div class="postingHolder">
            <h2><?php echo $s['name']; ?></h2>
            <?php $length = (100-strlen($s['name']) < 0)?0:100-strlen($s['name']); ?>
            <?php echo substr(str_replace('\\', '', $s['description']), 0, $length); ?> ...
            <a href="?page=user/content/show/<?php echo $s['content_id']; ?>">Read More <div style="color: #000; font-style: italic; float: right;">views <?php echo $s['count']; ?></div></a>
        </div>
        <?php } ?>
    </div>
    <div style="clear: both;">
    </div>
</div>
<div style="clear: both; background: #000; margin-top: 20px;">
    <div style="text-align: center;">
        <script type="text/javascript"><!--
        google_ad_client = "ca-pub-3792069331807752";
        /* The Spot - Advertisement */
        google_ad_slot = "8121286177";
        google_ad_width = 728;
        google_ad_height = 90;
        //-->
        </script>
        <script type="text/javascript"
        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>
    </div>
</div>  
<div class="rowHolder">
    <h2>
    	New Artists
    	<a href="?page=user/artists" class="moreLink">view more</a>
    </h2>
    <?php $users = $this->info['artists'];  ?>
    <?php foreach($users as $k=>$u){ ?>
        <?php $this->showUser($u);?>
    <?php } ?>
    <div class="clear"></div>
</div>
<div class="rowHolder">
    <h2>
    	New Users
    	<a href="?page=user/general" class="moreLink">view more</a>	
    </h2>
    <?php $users = $this->info['users']; ?>
    <?php foreach($users as $u){ ?>
    	<?php $this->showUser($u);?>
    <?php } ?>
    <div class="clear"></div>
</div>
</div>