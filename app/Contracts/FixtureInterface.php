<?php

namespace App\Contracts;

use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

interface FixtureInterface
{
    /**
     * @param int $week
     * @return Collection
     */
    public function getByWeek(int $week): Collection;

    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @return Collection
     */
    public function getUnplayedMatches(): Collection;

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

    /**
     * @return int
     */
    public function getLastWeek(): int;

    /**
     * @return int
     */
    public function getWeekCount(): int;

    /**
     * @return int
     */
    public function getRemainingWeekCount(): int;

    /**
     * @return bool
     */
    public function checkFixtureIsGenerated(): bool;
}
