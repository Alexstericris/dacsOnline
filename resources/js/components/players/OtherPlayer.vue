<template>
    <circle ref="player" :fill="character.attributes.color" :cx="xAxis" :cy="yAxis" :r="playerSize"/>
</template>

<script>
export default {
    name: "OtherPlayer",
    props: {
        character:Object,
    },
    data() {
        return {
            playerSize:50,
            xAxis: 100,
            yAxis: 100,
        }
    },
    created() {
        this.setStartingPosition();
    },

    methods:{
        setStartingPosition() {
            this.xAxis = this.character.character_position.x_axis;
            this.yAxis = this.character.character_position.y_axis;
        },
    },
    watch: {
        character:{
            deep:true,
            handler: function(value){
                console.log(value);
                this.xAxis = value.character_position.x_axis;
                this.yAxis = value.character_position.y_axis;
            }
        }
    }
}
</script>
<style scoped>

</style>
