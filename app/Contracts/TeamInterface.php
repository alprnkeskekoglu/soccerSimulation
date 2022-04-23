<?php

namespace App\Contracts;

use App\Models\Team;

interface TeamInterface
{
    /**
     * @param int $id
     * @return Team
     */
    public function getById(int $id): Team;

    /**
     * @param Team $team
     * @return float
     */
    public function getChampionshipRate(Team $team): float;


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
