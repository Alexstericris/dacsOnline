<template>
<base-layer>
        <player></player>
    </base-layer>
</template>

<script>
import Player from "../player/Player";
import BaseLayer from "../BaseLayer";
export default {
name: "Lobby",
    components: {BaseLayer, Player},
}
</script>

<style scoped>

</style>