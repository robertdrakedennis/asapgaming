<template>
    <div>
        <div class="input-field">
            <label for="search">Search</label>
            <input type="text" v-model.lazy="search" id="search">

        </div>

        <div class="input-field">
            <label for="credits">Credits</label>
            <input v-model.number="credits" type="number" @change="eurToCredits" @keypress="eurToCredits" id="credits" placeholder="600">
        </div>
        <div class="input-field">
            <label for="eur">Eur</label>
            <input v-model.number="eur" type="number" id="eur" @change="creditsToEur" @keypress="creditsToEur" placeholder="6">
        </div>
        <div v-if="noResults === false">
            <ul class="list-group">
                <li class="text-light list-group-item bg-transparent border-0" style="text-decoration: none;">
                    <img :src="this.result.avatar" alt="">
                    <div>{{result.name}}</div>
                    <div class="text-muted">{{result.steam_account_id}}</div>
                </li>
            </ul>
            <form method="POST" action="https://www.paypal.com/cgi-bin/webscr" class="w-100">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="item_name" :value="'Credits - ' + this.credits">
                <input type="hidden" name="business" value="saras2222@gmail.com">
                <input type="hidden" name="item_number" :value="this.uuid + '|' + '[U:1:' + this.steam_account_id + ']' + '|' + this.datetime">
                <input type="hidden" name="no_shipping" value="1">
                <input type="hidden" name="lc" value="US">
                <input type="hidden" name="currency_code" value="EUR">
                <input type="hidden" name="amount" id="amount" value="6">
                <input type="hidden" name="handling" value="0">
                <input type="hidden" name="custom" :value="this.result.steam_account_id">
                <input type="hidden" name="cancel_return" value="https://asapgaming.co/store">
                <input type="hidden" name="return" value="https://asapgaming.co/store">
                <input type="hidden" name="rm" value="2">
                <input type="hidden" name="notify_url" value="https://www.asapgaming.co/paypal/notify">
                <button type="submit" id="pay-with-paypal" class="btn btn-lg btn-primary btn-block" :disabled=isDisabled><i class="fab fa-paypal"></i> Pay with PayPal</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "StoreModalComponent",
        props: [
            'steam_account_id',
            'api_url',
            'uuid',
            'datetime'
        ],
        data() {
            return {
                search: null,
                result: [],
                noResults: true,
                credits: 600,
                eur: 6,
                isDisabled: false
            };
        },

        mounted: function () {
            axios.get(`${this.api_url + this.steam_account_id}`)
                .then(
                    response => this.result = response.data,
                    this.noResults = false
                )
                .catch(error => {
                    this.noResults = true;
                    console.log(error)
                });
        },

        watch: {
            search(after, before) {
                this.fetch();
            },
        },

        methods: {
            fetch: function () {
                axios.get(`${this.api_url + this.search}`)
                    .then(response => this.result = response.data, this.noResults = false)
                    .catch(error => {
                        this.noResults = true;
                        console.log(error)
                    });
            },

            creditsToEur(){
                this.credits = parseFloat(this.eur * 100);
                this.isDisabled = this.credits < 600 || this.eur < 6;
            },
            eurToCredits(){
                this.eur = parseFloat(this.credits / 100);
                this.isDisabled = this.eur < 6 || this.credits < 600;
            },
        }
    }
</script>

<style scoped>

</style>
