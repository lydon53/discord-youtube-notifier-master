<?php

/// ~ Change these values! ~ ///

// YouTube channel ID(s)
// Can be multiple channels - eg: `array("aaaaaaaaaaaaaaaaaaaa", "bbbbbbbbbbbbbbbbbbbb")`
const CHANNELIDS = array(UCgTRsWgqQyMUdt18beMKHtg);

// Public callback URL
const CALLBACKURL = https://discordapp.com/api/webhooks/386394577398923268/QgakZ7FWty668YR9ZtQenETfuQo3zSNqfoqlkcllcLjJFygWQy8HGFGReHFEvsXEEDtk;

// Secret - must match ytnotify.php; should be reasonably hard to guess
const SECRET = DHJ8NB4YIPQ7;

///   ///   ///  ///   ///   ///


foreach (CHANNELIDS as $chid) {
    echo "Subscribing to $chid...\n";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pubsubhubbub.appspot.com/subscribe",
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => array(
            'hub.mode' => 'subscribe',
            'hub.topic' => 'https://www.youtube.com/xml/feeds/videos.xml?channel_id=' . $chid,
            'hub.callback' => CALLBACKURL,
            'hub.secret' => SECRET,
            'hub.verify' => 'sync'
        ),
        CURLOPT_RETURNTRANSFER => TRUE
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    echo "$response\n";
}

echo "Done.\n";

?>
