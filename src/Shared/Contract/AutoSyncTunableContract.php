<?php

declare(strict_types=1);

namespace App\Shared\Contract;

interface AutoSyncTunableContract
{
    public function turnOnAutoSync(): void;

    public function turnOffAutoSync(): void;
}