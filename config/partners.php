<?php

return [

    'wm' => [
        'endpoint' => 'https://abwb-261.wmapi88.com/api/public/Gateway.php',
        'tokenCron' => '123456ahfncgda',
        'endpointHistory' => 'https://cron.ibet66.com/',
        'wm_vendorid' => 'j54ib6api',
        'wm_signature' => '73d59d4e8118d336c70871eace333eb5',
        'api' => [
            'register' => [
                'cmd' => 'MemberRegister',
                'method' => 'GET'
            ],
            'login' => [
                'cmd' => 'SigninGame',
                'method' => 'GET'
            ],
            'change_balance' => [
                'cmd' => 'ChangeBalance',
                'method' => 'GET'
            ],
            'get_balance' => [
                'cmd' => 'GetBalance',
                'method' => 'GET'
            ],
            'getHistoryGame' => [
                'uri' => 'api/getHistory',
                'method' => 'GET',
            ],
        ]
    ],
    'ae' => [
        'endpoint' => 'https://api.onlinegames22.com/',
        'tokenCron' => '123456ahfncgda',
        'endpointHistory' => 'https://cron.ibet66.com/',
        'agentId' => 'a226j54ib6',
        'cert' => 'BH8LfaFf8faCGojy0Nq',
        "currency" => "VND",
        "language" => "vn",
        'contentType' => 'application/x-www-form-urlencoded',
        'api' => [
            'register' => [
                'uri' => 'wallet/createMember',
                'method' => 'POST',
                "betLimit" => '{"SEXYBCRT":{"LIVE":{"limitId":[381101,381102,381108,381109,381110,381111]}}}',
            ],
            'login' => [
                'uri' => 'wallet/login',
                'method' => 'POST',
                "betLimit" => '{"SEXYBCRT":{"LIVE":{"limitId":[381101,381102,381108,381109,381110,381111]}}}',
            ],
            'withdraw' => [
                'uri' => 'wallet/withdraw',
                'method' => 'POST',
                "betLimit" => '{"SEXYBCRT":{"LIVE":{"limitId":[381101,381102,381108,381109,381110,381111]}}}',
            ],
            'deposit' => [
                'uri' => 'wallet/deposit',
                'method' => 'POST',
                "betLimit" => '{"SEXYBCRT":{"LIVE":{"limitId":[381101,381102,381108,381109,381110,381111]}}}',
            ],
            'getBalance' => [
                'uri' => 'wallet/getBalance',
                'method' => 'POST',
                "betLimit" => '{"SEXYBCRT":{"LIVE":{"limitId":[381101,381102,381108,381109,381110,381111]}}}',
            ],
            'getHistoryGame' => [
                'uri' => 'api/getHistory',
                'method' => 'GET',
            ],
        ]
    ],
    'evol' => [
        'endpoint' => 'https://api.luckylivegames.com',
        'tokenCron' => '123456ahfncgda',
        'endpointHistory' => 'https://cron.ibet66.com/',
        'key' => 'mowuocxbnmtp2ukn',
        'token' => 'e27ece3171b4851448092e65b38bb99f',
        'api' => [
            'register' => [
                'method' => 'POST'
            ],
            'withdraw' => [
                'method' => 'GET'
            ],
            'getHistoryGame' => [
                'uri' => 'api/getHistory',
                'method' => 'GET',
            ],
        ]
    ],
    'cq9' => [
        'endpoint' => 'https://apid.cqgame.cc',
        'tokenCron' => '123456ahfncgda',
        'endpointHistory' => 'https://cron.ibet66.com/',
        'agentId' => 'j54ib6api',
        'password' => 'j54ib6api',
        'curency' => 'VNDK',
        'key' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyaWQiOiI2MzYxMzhmOTlmYWI1OTY2ZDMxNjMxNzciLCJhY2NvdW50IjoiajU0aWI2YXBpIiwib3duZXIiOiI2MDBjMDcwNDIzOWM1YTAwMDE0ZTE0ZmQiLCJwYXJlbnQiOiI2MDBjMDcwNDIzOWM1YTAwMDE0ZTE0ZmQiLCJjdXJyZW5jeSI6IlZORCIsImp0aSI6IjE5NzA5MTIzNSIsImlhdCI6MTY2NzMxNTk2MSwiaXNzIjoiQ3lwcmVzcyIsInN1YiI6IlNTVG9rZW4ifQ.jI4APTq6HVCaO4L0EpSgSyDQuZzmQJkHJxwgJcQHNog',
        'api' => [
            'register' => [
                'method' => 'POST',
                'url' => '/gameboy/player',
                'contentType' => 'application/x-www-form-urlencoded'
            ],
            'login' => [
                'method' => 'POST',
                'url' => '/gameboy/player/login',
                'contentType' => 'application/x-www-form-urlencoded'
            ],
            'getLinkGame' => [
                'method' => 'POST',
                'url' => '/gameboy/player/gamelink',
                'contentType' => 'application/x-www-form-urlencoded'
            ],
            'withdraw' => [
                'method' => 'POST',
                'url' => '/gameboy/player/withdraw',
                'contentType' => 'application/x-www-form-urlencoded'
            ],
            'deposit' => [
                'method' => 'POST',
                'url' => '/gameboy/player/deposit',
                'contentType' => 'application/x-www-form-urlencoded'
            ],
            'get_balance' => [
                'method' => 'GET',
                'url' => '/gameboy/player/balance',
                'contentType' => 'application/x-www-form-urlencoded'
            ],
            'getHistoryGame' => [
                'uri' => 'api/getHistory',
                'method' => 'GET',
            ],
        ]
    ],
    'jdb' => [
        'endpoint' => 'http://api.jdb1688.net/apiRequest.do?dc=LX&x=',
        'tokenCron' => '123456ahfncgda',
        'endpointHistory' => 'https://cron.ibet66.com/',
        'dc' => 'LX',
        'iv' => 'wn1g4c6lb34jhzj2',
        'key' => 'gczfsp2x6z4l74am',
        'account' => 'a226j54ib6',
        'api' => [
            'register' => [
                'action' => 12,
                'method' => 'GET'
            ],
            'loginGame' => [
                'action' => 11,
                'method' => 'GET'
            ],
            'transfer' => [
                'action' => 19,
                'method' => 'GET'
            ],
            'getHistoryGame' => [
                'uri' => 'api/getHistory',
                'method' => 'GET',
            ],
        ]
    ],
    'jili' => [
        'endpoint' => 'https://uat-wb-api.jlfafafa2.com/api1/',
        'tokenCron' => '123456ahfncgda',
        'endpointHistory' => 'https://cron.ibet66.com/',
        'agentId' => 'AB_j54vnd_VND',
        'agentKey' => '8928731dc2e058a8ad92abc36b0a32835b3b0309',
        // 'timezone' => 'UTC -4',
        'api' => [
            'register' => [
                'method' => 'POST',
                'url' =>'CreateMember'
            ],
            'getBalance' => [
                'method' => 'POST',
                'url' => 'GetMemberInfo'
            ],
            'getHistoryGame' => [
                'uri' => 'api/getHistory',
                'method' => 'GET',
            ],
        ]
    ],
    'allbet' => [
        'endpoint' => 'https://mw2.absvc.net',
        'tokenCron' => '123456ahfncgda',
        'endpointHistory' => 'https://cron.ibet66.com/',
        'agentId' => 'j54ibyj',
        'agentKey' => 'CvW/lqT/oAVZPPBJ4R9slMpUhLBBzBhcYB0RHuCGi4zPX+I+MXjzfK5HixQYwgSXuwjTeiKd5KsOFTk/uKLlXQ==',
        'operatorId' => '6128847',
        'suffix' => 'ig0',
        'api' => [
            'register' => [
                'method' => 'POST',
                'url' =>'/CheckOrCreate'
            ],
            'login' => [
                'method' => 'POST',
                'url' =>'/Login'
            ],
            'transfer' => [
                'method' => 'POST',
                'url' =>'/Transfer'
            ],
            'get_balances' => [
                'method' => 'POST',
                'url' =>'/GetBalances'
            ],
            'getHistoryGame' => [
                'uri' => 'api/getHistory',
                'method' => 'GET',
            ],
        ]
    ],
    'saba' => [
        'endpoint' => 'http://103.150.125.209:5555/',
        'tokenCron' => '123456ahfncgda',
        'endpointHistory' => 'https://cron.ibet66.com/',
        'agentId' => 'j54ibetapi',
        'vendorId' => 'mk45ownbte',
        'brandName' => 'j54ibetapi',
        "currency" => "51", //RMB
        "language" => "vn",
        'api' => [
            'register' => [
                'uri' => 'PushSaba',
                'method' => 'POST',
            ],
            'login' => [
                'uri' => 'PushSaba',
                'method' => 'POST',
            ],
            'fundwallet' => [
                'uri' => 'PushSaba',
                'method' => 'POST',
            ],
            'getBalance' => [
                'uri' => 'PushSaba',
                'method' => 'POST',
            ],
            'getHistoryGame' => [
                'uri' => 'api/getHistory',
                'method' => 'GET',
            ],
        ]
    ],
    'v8poker' => [
        'endpoint' => 'https://api.zms32.com/channelHandle',
        'tokenCron' => '123456ahfncgda',
        'endpointHistory' => 'https://cron.ibet66.com/',
        'agentId' => '81178',
        'desKey' => 'C49052AF7C134F4E',
        'md5Key' => '4CB48633DF6019CA',
        'api' => [
            'getHistoryGame' => [
                'uri' => 'api/getHistory',
                'method' => 'GET',
            ],
        ]
    ],
    'avia' => [
        'endpoint' => 'https://api.avia.ph',
        'tokenCron' => '123456ahfncgda',
        'endpointHistory' => 'https://cron.ibet66.com/',
        'agentId' => 'j54ibet66',
        'key' => '860cc5e2fe6744148fbdaa394ce6816f',
        'api' => [
            'register' => [
                'uri' => '/api/user/register',
                'method' => 'POST',
            ],
            'login' => [
                'uri' => '/api/user/login',
                'method' => 'POST',
            ],
            'transfer' => [
                'uri' => '/api/user/transfer',
                'method' => 'POST',
            ],
            'getBalance' => [
                'uri' => '/api/user/balance',
                'method' => 'POST',
            ],
            'getHistoryGame' => [
                'uri' => 'api/getHistory',
                'method' => 'GET',
            ],
        ]
    ],
    'cmd' => [
        'endpoint' => 'http://api.fts368.com',
        'tokenCron' => '123456ahfncgda',
        'endpointHistory' => 'https://cron.ibet66.com/',
        'agentKey' => '2971893202801903',
        'agentCode' => 'IBE',
        'api' => [
            'getHistoryGame' => [
                'uri' => 'api/getHistory',
                'method' => 'GET',
            ],
        ]
    ],
    'dg' => [
        'endpoint' => 'http://api.dg99web.com',
        'tokenCron' => '123456ahfncgda',
        'endpointHistory' => 'https://cron.ibet66.com/',
        'agentId' => 'DG01400156',
        'key' => 'b926c8ce960d45dfb990d26d07f0eff8',
        'api' => [
            'register' => [
                'uri' => '/user/signup/DG01400156',
                'method' => 'POST',
            ],
            'login' => [
                'uri' => '/user/login/DG01400156',
                'method' => 'POST',
            ],
            'transfer' => [
                'uri' => '/account/transfer/DG01400156',
                'method' => 'POST',
            ],
            'getBalance' => [
                'uri' => '/user/getBalance/DG01400156',
                'method' => 'POST',
            ],
            'getHistoryGame' => [
                'uri' => 'api/getHistory',
                'method' => 'GET',
            ],
        ]
    ],
];

