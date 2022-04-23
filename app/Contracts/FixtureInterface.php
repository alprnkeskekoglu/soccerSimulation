<?php

namespace App\Contracts;

use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

interface FixtureInterface
{
    /**
     * @param int $week
     * @return Fixture
     */
    public function getByWeek(int $week): Fixture;

    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param Team $team
     * @return Collection
     */
    public function getByTeam(Team $team): Collection;

    /**
     * @param array $data
     * @return Fixture
     */
    public function store(array $data): Fixture;

    /**
     * @param Fixture $fixture
     * @param array $data
     * @return Fixture
     */
    public function update(Fixture $fixture, array $data): Fixture;
}
