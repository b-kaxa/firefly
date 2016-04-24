<?php
declare(strict_types = 1);

namespace Firefly\Entity;

use Firefly\EntityTrait;

class Sticker
{
    use EntityTrait;

    public function setContentMetaData(array $metadata)
    {
        $this->content['contentMetadata']['STKID'] = $metadata['STKID'];
        $this->content['contentMetadata']['STKPKGID'] = $metadata['STKPKGID'];
        $this->content['contentMetadata']['STKVER'] = $metadata['STKVER'];
    }
}