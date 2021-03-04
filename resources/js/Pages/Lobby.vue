<template>
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lobby
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <base-layer>
                        <player v-if="this.player"
                            :character="player"></player>
                        <template v-for="otherPlayer in otherPlayers">
                         <component
                             :character="otherPlayer"
                              is="OtherPlayer"></component>
                        </template>
                    </base-layer>
                </div>
            </div>
        </div>
    </AppLayout>

</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import BaseLayer from "@/components/BaseLayer";
import Player from "@/components/players/Player";
import OtherPlayer from "@/components/players/OtherPlayer";
import MapApi from "@/Apis/mapApi";
export default {
name: "Lobby",
    components: {AppLayout, BaseLayer, Player,OtherPlayer},
    data() {
        return{
            api: new MapApi(window.location.pathname),
            player:null,
            otherPlayers: []
        }
    },
    async created() {
        await this.api.getPlayers().then(response => {
            this.player = response.data.player;
            this.otherPlayers = response.data.otherPlayers;
        });
        Echo.private(`App.Models.Map.1`)
            .listen('PlayerMoved', (e) => {
                console.log(e);
            });
    },
}
</script>

<style scoped>

</style>
