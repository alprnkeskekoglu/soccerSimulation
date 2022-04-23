<template>
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <td>Team Name</td>
                            <td>P</td>
                            <td>W</td>
                            <td>D</td>
                            <td>L</td>
                            <td>GD</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="team in teams">
                            <td>{{ team.name }} ({{ team.power }})</td>
                            <td>{{ team.points }}</td>
                            <td>{{ team.won }}</td>
                            <td>{{ team.drawn }}</td>
                            <td>{{ team.lost }}</td>
                            <td>{{ team.goal_difference }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-3">
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <td>Next Week</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in fixture">
                            <td class="d-flex justify-content-between">
                                <span>{{ item.home_team }}</span>
                                <span>{{ item.home_team_score + ' - ' + item.away_team_score }}</span>
                                <span>{{ item.away_team }}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-3">
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <td>Championship Prodictions</td>
                            <td>%</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="team in teams">
                            <td>{{ team.name }}</td>
                            <td>{{ 0 }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
        </div>
        <div class="col-lg-12 d-flex justify-content-around">
            <button class="btn btn-primary" @click="playAll" :disabled="week >= weekCount">Play All Weeks</button>
            <button class="btn btn-primary" @click="playWeek" :disabled="week >= weekCount">Play Next Weeks</button>
            <button class="btn btn-danger" @click="refresh">Reset Data</button>
        </div>
        <div class="col-lg-12 mt-5">
            <div class="row">
                <div class="col-lg-3" v-for="(fixture, week) in fixtures">
                    <table class="table">
                        <thead class="table-dark">
                        <tr>
                            <td>Week {{ week }}</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in fixture">
                            <td class="d-flex justify-content-between">
                                <span>{{ item.home_team }}</span>
                                <span>{{ item.home_team_score + ' - ' + item.away_team_score }}</span>
                                <span>{{ item.away_team }}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Simulation",
    data() {
        return {
            teams: {},
            fixtures: {},
            fixture: {},
            week: 1,
            weekCount: 1,
        }
    },
    watch: {
        week(value) {

            this.getFixtureByWeek();
            this.getFixtures();
            this.getTeams();
        }
    },
    created() {
        this.getWeekCount();
        this.getLastWeek();
        this.getTeams();
        this.getFixtures();
        this.getFixtureByWeek();
    },
    methods: {
        getWeekCount() {
            axios.get('/api/simulations/get-week-count')
                .then(response => this.weekCount = response.data);
        },
        getLastWeek() {
            axios.get('/api/simulations/get-last-week')
                .then(response => {
                    this.week = response.data > this.weekCount ? this.weekCount : response.data;
                });
        },
        getTeams() {
            axios.get('/api/teams/get-all')
                .then(response => this.teams = response.data)
                .catch(error => console.log(error))
        },
        getFixtures() {
            axios.get('/api/fixtures/get-grouped-by-week')
                .then(response => this.fixtures = response.data)
                .catch(error => console.log(error))
        },
        getFixtureByWeek() {
            axios.get('/api/fixtures/get-by-week/' + this.week)
                .then(response => this.fixture = response.data)
                .catch(error => console.log(error))
        },
        playWeek() {
            axios.get('/api/simulations/play/' + this.week)
                .then(() => this.week++)
                .catch(error => console.log(error))
        },
        playAll() {
            axios.get('/api/simulations/play-all')
                .then(response => this.week = this.weekCount)
                .catch(error => console.log(error))
        },
        refresh() {
            axios.get('/api/simulations/refresh')
                .then(response => this.week = 1)
                .catch(error => console.log(error))
        }
    }
}
</script>
