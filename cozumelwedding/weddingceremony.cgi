#!/usr/bin/perl -w
use strict;
use CGI qw(:standard);
my $cgi = new CGI;
#print "Content-type: text/html\n\n"; #not needed because of print header()

my $html5 = "";
my $quality = "";
my $videoURL = "";
my $videoSize = "";
my $changeQuality = "";
my $html5width = "853";

####Get HTML5####
if (param("html5") ne "") { $html5 = param("html5"); } 
elsif ($cgi->cookie("html5") ne "") { $html5 = $cgi->cookie("html5"); }
else { $html5 = "off"; } #default value
my $html5Cookie = cookie(-name => "html5", -value => $html5);

####Get Quality####
if (param("quality") ne "") { $quality = param("quality"); }
elsif ($cgi->cookie("quality") ne "") { $quality = $cgi->cookie("quality"); }
#else { $quality = "low"; }
my $qualityCookie = cookie(-name => "quality", -value => $quality);

#Send the cookies!
print header(-cookie => [$html5Cookie, $qualityCookie]);

#decide which version (quality) of the video to get
if ($quality eq "low") {
  $videoURL = "ceremony480p.mp4";
  $videoSize = "100 MB";
  $changeQuality = '<a href="weddingceremony.cgi?quality=high" style="font-size: 14px;">View in higher quality</a>';
}
elsif ($quality eq "high") {
  $videoURL = "ceremony720p.mp4";
  $videoSize = "458 MB";
  $changeQuality = '<a href="weddingceremony.cgi?quality=low" style="font-size: 14px;">View in lower quality</a>';
}

#construct the "change to HTML5" buttons depending on the setting
my $changeHTML5;
if ($html5 eq "on") {
  $changeHTML5 = '<a href="weddingceremony.cgi?html5=off" style="font-size: 14px;">Turn HTML5 Off</a>';
}
else {
  $changeHTML5 = '<a href="weddingceremony.cgi?html5=on" style="font-size: 14px;">Turn HTML5 On</a>';
}

print <<_endhtml_;
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>The Wedding Ceremony</title>
    <link href="videopagestyle.css" rel="stylesheet" type="text/css" />
    <link href='http://fonts.googleapis.com/css?family=Reenie+Beanie' rel='stylesheet' type='text/css'>
    <script src="../common/flowplayer-3.2.2.min.js"></script>
    <script type="text/javascript">
    
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-17716355-1']);
      _gaq.push(['_trackPageview']);
    
      (function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    
    </script>
    
    </head>
    
    <body>
    <div id="backbar">
	    <div style="float: left;">
	    <a href="index.html" style="margin-top: 7px;"><img src="backbutton.png" style="float: left" width="70" height="20" alt="Back" /><span style="padding-top: 12px">Back to Wedding Selection Page</span></a>
	</div>
	<div style="float: right; margin : 7px 15px 0 0;">
	    $changeQuality
	    $changeHTML5
	</div>
    </div>
    <div class="clearfloats"></div>
    <h1 font="google">The Wedding Ceremony</h1>
	    <div class="videoplayer">
_endhtml_

if ($quality ne "high" && $quality ne "low") {
  print <<_endhtml_;
		  <div id="qualitychooser">
		  <h1>Choose Your Quality:</h1>
		  <a href="weddingceremony.cgi?quality=high"><div class="button">High Quality</div></a>
		  <a href="weddingceremony.cgi?quality=low"><div class="button">Standard Quality</div></a>
		  <p>Please Note: High quality videos require a fast internet connection with download speeds of 3-4 mbps.</p>
_endhtml_
}

elsif ($html5 ne "on") {
  print <<_endhtml_;
		  <a 
			href="$videoURL" 
			style="display: block; width: 853px; height: 480px; margin: 0 auto 0 auto;" 
			id="player"><img src="weddingceremonyimg.jpg" alt="Click to Play" width="853" height="480" />
		  </a>
		    <script language="JavaScript">
			flowplayer("player", "../common/flowplayer-3.2.2.swf", {
			    clip:  {
				autoPlay: true,
				autoBuffering: true
			    }
			});
		    </script>
_endhtml_
}

elsif ($html5 eq "on") {
  print <<_endhtml_;
		  <video src="$videoURL" height="480" width="$html5width" controls="controls" preload="auto" autoplay="autoplay">
		    Sorry, your browser does not support HTML5 video playback on this site.  You must be using a recent version of Google Chrome, Safari, or Internet Explorer 9 is required.
		  </video>
_endhtml_
}

print <<_endhtml_;
	</div>
	<center><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwatkinsca.com%2Fcozumelwedding%2Findex.html&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=like&amp;colorscheme=dark&amp;height=35" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:270px; height:35px; margin: 8px 0 0 0;" allowTransparency="true"></iframe></center>
	    <p class="meta">If you are experiencing problems loading the video, please make sure you are viewing it in standard quality.  In some cases, it may help to simply pause the video and allow it to buffer.  If all else fails, feel free to download the video below and watch it directly from your computer.</p>
_endhtml_

if ($videoSize != 0) {
print <<_endhtml_;
	<div class="nounderline" style="width: 266px; margin: 0 auto 0 auto;"><a href="$videoURL">
	<div class="button">Download Video ($videoSize)</div>
      </a></div>
_endhtml_
}

my $commentsMargin = "";
if ($videoSize eq "") {
  $commentsMargin = 'style="margin-top: 200px;"'; #weird bug!!
}

print <<_endhtml_;
	    <div style="margin: 20px auto 0 auto; width: 300px;"><h2><table width="300" border="0" cellspacing="0" cellpadding="0" align="center">
	      <tr>
		<td width="56"><a href="http://picasaweb.google.com/116214600677210676101" target="_blank"><img src="picasalogo.jpg" width="50" height="45" alt="Picasa" /></a></td>
		<td width="244" align="right"><a href="http://picasaweb.google.com/116214600677210676101" target="_blank">Click Here to View Pictures</a></td>
	      </tr>
	    </table></h2></div>	
    </div>
    <div class="clearfloats"></div>
    <div class="bottommeta" $commentsMargin>
	    <p>To leave a comment, you may remain anonymous or sign in to your Google, Twitter, Yahoo, AIM, Netlog, or OpenID account below:</p><br />
	      <center>
	      <!-- Include the Google Friend Connect javascript library. -->
		  <script type="text/javascript" src="http://www.google.com/friendconnect/script/friendconnect.js"></script>
            <!-- Define the div tag where the gadget will be inserted. -->
            <div id="div-2717244627939450223" style="width:600px;"></div>
            <!-- Render the gadget into a div. -->
          <script type="text/javascript">
            var skin = {};
            skin['BORDER_COLOR'] = 'transparent';
            skin['ENDCAP_BG_COLOR'] = '#000000';
            skin['ENDCAP_TEXT_COLOR'] = '#ffffff';
            skin['ENDCAP_LINK_COLOR'] = '#0CF';
            skin['ALTERNATE_BG_COLOR'] = '#000000';
            skin['CONTENT_BG_COLOR'] = '#000000';
            skin['CONTENT_LINK_COLOR'] = '#0CF';
            skin['CONTENT_TEXT_COLOR'] = '#ffffff';
            skin['CONTENT_SECONDARY_LINK_COLOR'] = '#0CF';
            skin['CONTENT_SECONDARY_TEXT_COLOR'] = '#c0c0c0';
            skin['CONTENT_HEADLINE_COLOR'] = '#333333';
            skin['ALIGNMENT'] = 'center';
            google.friendconnect.container.setParentUrl('/' /* location of rpc_relay.html and canvas.html */);
            google.friendconnect.container.renderSignInGadget(
             { id: 'div-2717244627939450223',
               site: '14613135991466124949' },
              skin);
            </script><br />
      <!-- Include the Google Friend Connect javascript library. -->
			<script type="text/javascript" src="http://www.google.com/friendconnect/script/friendconnect.js"></script>
            <!-- Define the div tag where the gadget will be inserted. -->
            <div id="div-287764369462033109" style="width:720px;border:1px solid #333333;"></div>
            <!-- Render the gadget into a div. -->
            <script type="text/javascript">
            var skin = {};
            skin['BORDER_COLOR'] = '#333333';
            skin['ENDCAP_BG_COLOR'] = '#333333';
            skin['ENDCAP_TEXT_COLOR'] = '#FFFFFFF';
            skin['ENDCAP_LINK_COLOR'] = '#0CF';
            skin['ALTERNATE_BG_COLOR'] = '#ffffff';
            skin['CONTENT_BG_COLOR'] = '#ffffff';
            skin['CONTENT_LINK_COLOR'] = '#0000cc';
            skin['CONTENT_TEXT_COLOR'] = '#333333';
            skin['CONTENT_SECONDARY_LINK_COLOR'] = '#7777cc';
            skin['CONTENT_SECONDARY_TEXT_COLOR'] = '#666666';
            skin['CONTENT_HEADLINE_COLOR'] = '#ffffff';
            skin['DEFAULT_COMMENT_TEXT'] = 'Comment Here!  Be sure to sign in above if you do not want to remain anonymous!';
            skin['HEADER_TEXT'] = 'Comments';
            skin['POSTS_PER_PAGE'] = '15';
            google.friendconnect.container.setParentUrl('/' /* location of rpc_relay.html and canvas.html */);
            google.friendconnect.container.renderWallGadget(
             { id: 'div-287764369462033109',
               site: '14613135991466124949',
               'view-params':{"disableMinMax":"true","scope":"ID","allowAnonymousPost":"true","features":"video,comment","docId":"Wedding Ceremony","startMaximized":"true"}
             },
              skin);
            </script>
      </center>    
    </div>
    </body>
    </html>
_endhtml_
