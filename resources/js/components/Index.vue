<template>
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
</template>

<script>
export default {
    name: "Index",
    data() {
        return {
            teams: {}
        }
    },
    created() {
        this.getTeams();
    },
    methods: {
        getTeams() {
            axios.get('/api/teams/get-all')
                .then(response => this.teams = response.data)
                .catch(error => console.log(error))
        }
    }
}
</script>
