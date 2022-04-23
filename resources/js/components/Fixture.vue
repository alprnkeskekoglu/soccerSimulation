<template>
    <div class="row mt-5">
        <div class="col-lg-12" v-if="fixtures.length == 0">
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i>
                {{ message }}
            </div>
        </div>
        <div class="col-lg-12" v-else>
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
    name: "Fixture",
    data() {
        return {
            message: 'Fixtures are now being created. Please wait.',
            fixtures: [],
        }
    },
    created() {
        this.generate();
    },
    methods: {
        generate() {
            this.$root.loading = true;
            axios.get('/api/fixtures/generate')
                .then(response => this.message = response.data.message)
                .catch(error => console.log(error))
                .then(() => this.getFixtures());
        },
        getFixtures() {
            axios.get('/api/fixtures/get-grouped-by-week')
                .then(response => this.fixtures = response.data)
                .catch(error => console.log(error))
                .finally(() => this.$root.loading = false);
        }
    }
}
</script>
