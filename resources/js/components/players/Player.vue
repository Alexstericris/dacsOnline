<template>
    <circle ref="player" :fill="character.attributes.color" :cx="xAxis" :cy="yAxis" :r="playerSize"/>
</template>

<script>
export default {
    name: "Player",
    props: {
        character:Object,
    },
    data() {
        return {
            playerSize:50,
            xAxis: 100,
            yAxis: 100,
            xDir: '',
            yDir: '',
            direction: '',
            ticks: 0,
            ticksRate:10,
            acceleration: 1,
            velocity: 0,
            maxVelocity: 10,
            heading: '',
            gameLoop: null,
            mainSVG:document.getElementById('mainSVG')
        }
    },
    computed: {
        inputs() {
            return this.xDir || this.yDir;
        },
        noInputs() {
            return !this.xDir && !this.yDir;
        },

    },
    created() {
        this.setStartingPosition();
        this.loop();
        let keyDownHandler=(event)=>{
            event.preventDefault();
            if(event.key==="Escape"){
                window.removeEventListener('keydown',keyDownHandler,false)
            }
            if (event.key === 'ArrowUp' || event.key === 'w') {
                this.yDir = 'up';
            }
            if (event.key === 'ArrowLeft' || event.key === 'a') {
                this.xDir = 'left';
            }
            if (event.key === 'ArrowDown' || event.key === 's') {
                this.yDir = 'down';
            }
            if (event.key === 'ArrowRight' || event.key === 'd') {
                this.xDir = 'right';
            }
            this.direction = this.yDir + this.xDir;
        }
        let keyUpHandler=(event)=>{
            event.preventDefault();
            if(event.key==="Escape"){
                window.removeEventListener('keydown',keyUpHandler,false)
            }
            if (['ArrowUp', 'ArrowDown', 'w', 's'].includes(event.key)) {
                this.yDir = '';
            }
            if (['ArrowLeft', 'ArrowRight', 'a', 'd'].includes(event.key)) {
                this.xDir = '';
            }
        }
        window.addEventListener("keydown",keyDownHandler);
        window.addEventListener("keyup",keyUpHandler);
    },
    methods: {
        loop() {
            this.ticks++
            this.update()
            requestAnimationFrame(this.loop)
        },
        setStartingPosition() {
            this.xAxis = this.character.character_position.x_axis;
            this.yAxis = this.character.character_position.y_axis;
        },
        update() {
            if (this.inputs) {
                if (this.ticks % this.ticksRate === 0) {
                    if (this.velocity < this.maxVelocity) {
                        this.velocity += this.acceleration
                    } else {
                        this.velocity = this.maxVelocity;
                    }
                }
                this.movePlayer()
            } else if (this.direction) {
                this.movePlayer()
                if (this.ticks % this.ticksRate === 0) {
                    if (this.velocity > 0) {
                        this.velocity -= this.acceleration
                    } else {
                        this.velocity = 0;
                        this.direction = '';
                    }
                }
            }
        },
        movePlayer() {
            let positionChanged=false
            if (this.direction.includes('up')) {
                if(this.yAxis - this.velocity < 50){
                    this.yAxis=this.playerSize
                }else{
                    this.yAxis -= this.velocity;
                }
                positionChanged=true
            }
            if (this.direction.includes('left')) {
                if(this.xAxis - this.velocity < 50){
                    this.xAxis=this.playerSize
                }else{
                    this.xAxis -= this.velocity;
                }
                positionChanged=true
            }
            if (this.direction.includes('down')) {
                if(this.yAxis + this.velocity > 670){
                    this.yAxis=670
                }else{
                    this.yAxis += this.velocity;
                }
                positionChanged=true
            }
            if (this.direction.includes('right')) {
                let gameWidth = document.getElementById('mainSVG').getBoundingClientRect().width;
                if(this.xAxis + this.velocity > (gameWidth-this.playerSize)){
                    this.xAxis=gameWidth-this.playerSize
                }else{
                    this.xAxis += this.velocity;
                }
                positionChanged=true
            }
            if(positionChanged){
                this.persistPosition();
            }
        },
        persistPosition(){
            axios.post('/movement/character/position/update',{
                'characterId':this.character.id,
                'xAxis':this.xAxis,
                'yAxis':this.yAxis
            })
        }
    }
}
</script>
<style scoped>

</style>
