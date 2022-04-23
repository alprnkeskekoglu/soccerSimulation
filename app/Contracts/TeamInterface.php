<?php

namespace App\Contracts;

use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

interface TeamInterface
{
    /**
     * @param int $id
     * @return Team
     */
    public function getById(int $id): Team;

    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param Team $team
     * @return float
     */
    public function getChampionshipRate(Team $team): float;


    /**
     * @param Fixture $fixture
     * @param array $data
     * @return void
     */
    public function update(Fixture $fixture, array $data): void;

    /**
     * @param Team $team
     * @param int $goalsFor
     * @param int $goalsAgainst
     * @return void
     */
    public function won(Team $team, int $goalsFor, int $goalsAgainst): void;

    /**
     * @param Team $team
     * @param int $goalsFor
     * @param int $goalsAgainst
     * @return void
     */
    public function drawn(Team $team, int $goalsFor, int $goalsAgainst): void;

    /**
     * @param Team $team
     * @param int $goalsFor
     * @param int $goalsAgainst
     * @return void
     */
    public function lost(Team $team, int $goalsFor, int $goalsAgainst): void;
}
