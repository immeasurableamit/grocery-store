<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface BrandRepositoryInterface
{
    public function all(): Collection;
}
