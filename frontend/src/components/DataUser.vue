<template>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid rounded-circle" :src="dados.avatar_url">
                </div>
                <div class="text-left">
                    <h3>{{ dados.name }}</h3>
                    <p class="text-muted">{{ dados.login }}</p>
                </div>

                <div class="mb-2">
                     <TheModal :bio="dados.bio" v-if="dados.bio"/>
                </div>
                <div>
                    <font-awesome-icon :icon="['fas', 'user-group']" /> {{ dados.followers }} followers - {{
                        dados.following }} following
                </div>

                <div>
                    <font-awesome-icon :icon="['fab', 'git-alt']" /> {{ dados.public_repos }} Public Repository
                </div>

                <div v-if="dados.company">
                    <font-awesome-icon :icon="['fas', 'building']" /> {{ dados.company }}
                </div>

                <div v-if="dados.location">
                    <font-awesome-icon :icon="['fas', 'location-dot']" /> {{ dados.location }}
                </div>

                <div v-if="dados.url">
                    <font-awesome-icon :icon="['fab', 'github']" /> {{ dados.url }}
                </div>

                <div v-if="dados.blog">
                    <font-awesome-icon :icon="['fas', 'link']" /> {{ dados.blog }}
                </div>
            </div>
        </div>

        <div class="col-md-8 col-sm-12 mt-2" v-if="dados.followingList">
            <input class="form-control" type="text" v-model="searchUser" placeholder="Buscar usuário...">

            <div v-for="(item, index) in filteredFollowingList" :key="index">
                <div class="row py-4 border-bottom">
                    <div class="col-2">
                        <img class="img-fluid rounded-circle" :src="item.avatar_url">
                    </div>

                    <div class="col-10">
                        <h3>{{ item.name }} <small class="text-muted">{{ item.login }}</small></h3>
                        <div v-if="item.bio">
                            <small class="text-muted">{{ item.bio }}</small>
                        </div>
                        <div>
                            <small class="text-muted me-4" v-if="item.company"> <font-awesome-icon
                                    :icon="['fas', 'building']" />
                                {{ item.company }}</small>
                            <small class="text-muted" v-if="item.location"> <font-awesome-icon
                                    :icon="['fas', 'location-dot']" />
                                {{ item.location }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import TheModal from './TheModal.vue';

export default {
    props: {
        dados: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            searchUser: "",
        };
    },
    components:{
        TheModal
    },
    computed: {
        filteredFollowingList() {
            return this.dados.followingList.filter(item => {
                const searchLower = this.searchUser.toLowerCase();
                return item.name?.toLowerCase().includes(searchLower) || item.login?.toLowerCase().includes(searchLower);
            });


        }
    }
};
</script>
