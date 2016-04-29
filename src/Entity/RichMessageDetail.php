<?php
declare(strict_types = 1);

namespace Firefly\Entity;

class RichMessageDetail
{
    public $detail = [
        'canvas' => [
            'width' => 1040,
            'height' => null,
            'initialScene' => 'scene1'
        ],
        'images' => [
            'image1' => [
                'x' => 0,
                'y' => 0,
                'width' => 1040,
                'height' => null,
            ]
        ],
        'actions' => [
            'openHomepage' => [
                'type' => 'web',
                'text' => 'text',
                'params' => [
                    'linkUri' => 'http://your.server.name/'
                ]
            ],
            'showItem' => [
                'type' => 'web',
                'text' => 'Show item.',
                'params' => [
                    'linkUri' => 'http://your.server.name/items/123'
                ]
            ]
        ],
        'scenes' => [
            'scene1' => [
                'draws' => [
                    [
                        'image' => 'image1',
                        'x' => 0,
                        'y' => 0,
                        'w' => 1040,
                        'h' => 1040
                    ]
                ],
                'listeners' => [
                    [
                        'type' => 'touch',
                        'params' => [0, 0, 1040, 350],
                        'action' => 'openHomepage'
                    ],
                    [
                        'type' => 'touch',
                        'params' => [0, 350, 1040, 350],
                        'action' => 'showItem'
                    ]
                ]
            ]
        ]
    ];

    public function setDetail(string $to)
    {
//        $this->to = [$to];
    }

    public function getDetail(): array
    {
        return $this->detail;
    }
}