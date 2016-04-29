<?php
declare(strict_types = 1);

namespace Firefly\Entity;

class RichMessageDetail
{
    public $detail = [
        'canvas' => [
            'width' => 1040,
            'height' => 1040,
            'initialScene' => 'scene1'
        ],
        'images' => [
            'image1' => [
                'x' => 0,
                'y' => 0,
                'width' => 460,
                'height' => 460,
            ]
        ],
        'actions' => [
            'openHomepage' => [
                'type' => 'web',
                'text' => 'text',
                'params' => [
                    'linkUri' => 'https://github.com/'
                ]
            ],
            'showItem' => [
                'type' => 'web',
                'text' => 'Show item.',
                'params' => [
                    'linkUri' => 'https://github.com/'
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
                        'w' => 460,
                        'h' => 460
                    ]
                ],
                'listeners' => [
                    [
                        'type' => 'touch',
                        'params' => [0, 0, 460, 230],
                        'action' => 'openHomepage'
                    ],
                    [
                        'type' => 'touch',
                        'params' => [0, 230, 460, 460],
                        'action' => 'showItem'
                    ]
                ]
            ]
        ]
    ];

    public function getDetail(): array
    {
        return $this->detail;
    }
}