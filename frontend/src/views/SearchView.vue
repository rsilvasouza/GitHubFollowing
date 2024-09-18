<template>
    <div class="container">
        <div class="mt-5">
            <DataUser :dados="dados" v-if="dados" />
        </div>
    </div>
</template>

<script>
import { useRoute } from 'vue-router';
import DataUser from '../components/DataUser';
import api from '../services/api';

export default {
    components: {
        DataUser,
    },
    data() {
        const route = useRoute();
        const username = route.params.username;
        return {
            username,
            dados: null,
        }
    },
    mounted() {
        api.get(this.username).then((response) => {
            this.dados = response.data;
            console.log(this.dados);
        }).catch(() => {
            this.$swal('Usuário não encontrado');
        })
    },
}
</script>