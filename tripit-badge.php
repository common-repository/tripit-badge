<?php
/*
Plugin Name: TripIt Badge
Plugin URI: http://samgabell.com/development/
Description: Allows you to insert your TripIt blog badge into your WordPress powered site
Author: Sam Gabell
Version: 1.0.1
Author URI: http://samgabell.com
*/

//Form start of TripIt Badge link
function open_badge()
{
echo "<ul><li><div id='badge-container'><script type='text/javascript' src='http://www.tripit.com/account/badge/id/";
}

//Finish TripIt Badge link
function close_badge()
{
echo  "/div_id/badge-container/badge.js'></script></div></li></ul>";
}

function widget_tripitBadge($args) {
extract($args);
$options = get_option("widget_tripitBadge");
if (!is_array( $options ))
{
$options = array(
'title' => ''
);
$options = array(
'badgeID' => ''
);
}

echo $before_widget;
echo $before_title;
echo $options['title'];
echo $after_title;
open_badge();
//Insert Personal TripIt Badge ID
echo $options['badgeID'];
close_badge();
echo $after_widget;
}

function tripitBadge_control()
{
$options = get_option("widget_tripitBadge");

if (!is_array( $options ))
{
$options = array(
'title' => ''
);
$options = array(
'badgeID' => ''
);
}

if ($_POST['tripitBadge-Submit'])
{
$options['title'] = htmlspecialchars($_POST['tripitBadge-WidgetTitle']);
$options['badgeID'] = htmlspecialchars($_POST['tripitBadge-BadgeID']);
update_option("widget_tripitBadge", $options);
}

?>
<p>
<label for="tripitBadge-WidgetTitle">Title: 
<input type="text" id="tripitBadge-WidgetTitle" class="widefat" name="tripitBadge-WidgetTitle" value="<?php echo $options['title'];?>" /></label>
</p>
<p>
<label for="tripitBadge-BadgeID">TripIt Badge ID: 
<input type="text" id="tripitBadge-BadgeID" class="widefat" name="tripitBadge-BadgeID" value="<?php echo $options['badgeID'];?>" /></label>
</p>
<input type="hidden" id="tripitBadge-Submit" name="tripitBadge-Submit" value="1" />
<?php
}

function tripitBadge_init()
{
register_sidebar_widget(__('TripIt Badge'), 'widget_tripitBadge');
register_widget_control( 'TripIt Badge', 'tripitBadge_control');
}
add_action("plugins_loaded", "tripitBadge_init");
?>
