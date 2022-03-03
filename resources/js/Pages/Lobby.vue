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
                        <template v-for="(otherPlayer,id) in otherPlayers">
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
            otherPlayers: {}
        }
    },
    async created() {
        await this.api.getPlayers().then(response => {
            this.player = response.data.player;
            this.otherPlayers = response.data.otherPlayers;
        });
        // console.log(window.Echo);

    },
    mounted() {
        socket.on('dacsonline_database_maps.1:maps.1', (data) => {
            if (this.otherPlayers[data.character_id]) {
                this.otherPlayers[data.character_id].character_position.x_axis=data.x_axis;
                this.otherPlayers[data.character_id].character_position.y_axis=data.y_axis
            }
        });
    }
}
</script>

<style scoped>

</style>
